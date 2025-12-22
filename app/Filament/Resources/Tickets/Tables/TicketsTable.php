<?php

namespace App\Filament\Resources\Tickets\Tables;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use App\Support\PanelContext;
use App\Notifications\TicketSubmittedNotification;
use App\Notifications\TicketManagerApprovedNotification;
use App\Notifications\TicketFinalApprovedNotification;
use App\Notifications\TicketRejectedNotification;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Notification as LaravelNotification;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Employee name (from ticket.user -> employee -> profile)
                TextColumn::make('employee_name')
                    ->label('Employee')
                    ->state(function (Ticket $record) {
                        return $record->user?->employee?->profile?->full_name
                            ?? $record->user?->name
                            ?? $record->user?->email
                            ?? '—';
                    })
                    ->searchable(query: function ($query, string $search) {
                        return $query
                            ->whereHas('user', function ($u) use ($search) {
                                $u->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%");
                            })
                            ->orWhereHas('user.employee.profile', function ($p) use ($search) {
                                $p->where('full_name', 'like', "%{$search}%");
                            });
                    })
                    ->visible(fn() => PanelContext::is('admin') || PanelContext::is('manager') || PanelContext::is('hr')),

                TextColumn::make('type.name')
                    ->label('Type')
                    ->badge()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof TicketStatus ? $state->value : (string) $state;

                        return match ($value) {
                            TicketStatus::PendingManager->value => 'Pending Manager',
                            TicketStatus::PendingHr->value => 'Pending HR',
                            TicketStatus::Approved->value => 'Approved',
                            TicketStatus::Rejected->value => 'Rejected',
                            default => $value,
                        };
                    })
                    ->color(function ($state) {
                        $value = $state instanceof TicketStatus ? $state->value : (string) $state;

                        return match ($value) {
                            TicketStatus::PendingManager->value => 'gray',
                            TicketStatus::PendingHr->value => 'warning',
                            TicketStatus::Approved->value => 'success',
                            TicketStatus::Rejected->value => 'danger',
                            default => 'gray',
                        };
                    })
                    ->sortable(),

                TextColumn::make('priority')
                    ->badge()
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('status')
                    ->options([
                        TicketStatus::PendingManager->value => 'Pending Manager',
                        TicketStatus::PendingHr->value => 'Pending HR',
                        TicketStatus::Approved->value => 'Approved',
                        TicketStatus::Rejected->value => 'Rejected',
                    ]),
            ])

            ->actions([])

            ->recordActions([
                ViewAction::make(),

                // =========================
                // Manager: Approve / Reject
                // =========================
                Action::make('manager_approve')
                    ->label('موافقة')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn(Ticket $record) => PanelContext::is('manager') && $record->status === TicketStatus::PendingManager)
                    ->form([
                        Textarea::make('manager_reason')->label('سبب الموافقة')->required()->rows(3),
                    ])
                    ->action(function (Ticket $record, array $data) {
                        $record->update([
                            'status' => TicketStatus::PendingHr,
                            'manager_approved' => true,
                            'manager_reason' => $data['manager_reason'],
                            'manager_action_at' => now(),
                            'manager_actor_email' => Filament::auth()->user()?->email,
                        ]);

                        // إرسال النوتفيكشن للموظفين في بانل HR
                        self::notifyPanelUsers('hr', new TicketManagerApprovedNotification($record));

                        // إرسال النوتفيكشن للموظف
                        $record->user?->notify(new TicketManagerApprovedNotification($record));

                        // إرسال نوتفيكشن للادمن
                        self::notifyPanelUsers('admin', new TicketManagerApprovedNotification($record));

                        Notification::make()->title('تم الموافقة من المدير')->success()->send();
                    }),

                Action::make('manager_reject')
                    ->label('رفض')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->visible(fn(Ticket $record) => PanelContext::is('manager') && $record->status === TicketStatus::PendingManager)
                    ->form([
                        Textarea::make('manager_reason')->label('سبب الرفض')->required()->rows(3),
                    ])
                    ->requiresConfirmation()
                    ->action(function (Ticket $record, array $data) {
                        $record->update([
                            'status' => TicketStatus::Rejected,
                            'manager_approved' => false,
                            'manager_reason' => $data['manager_reason'],
                            'manager_action_at' => now(),
                            'manager_actor_email' => Filament::auth()->user()?->email,
                        ]);

                        // إرسال نوتفيكشن للموظف بالرفض
                        $record->user?->notify(new TicketRejectedNotification($record, 'manager'));

                        // إرسال نوتفيكشن للادمن
                        self::notifyPanelUsers('admin', new TicketRejectedNotification($record, 'manager'));

                        Notification::make()->title('تم الرفض من المدير')->danger()->send();
                    }),

                // =========================
                // HR: Approve / Reject
                // =========================
                Action::make('hr_approve')
                    ->label('موافقة HR')
                    ->color('success')
                    ->icon('heroicon-o-shield-check')
                    ->visible(fn(Ticket $record) => PanelContext::is('hr') && $record->status === TicketStatus::PendingHr)
                    ->form([
                        Textarea::make('hr_reason')->label('سبب الموافقة')->required()->rows(3),
                    ])
                    ->action(function (Ticket $record, array $data) {
                        $record->update([
                            'status' => TicketStatus::Approved,
                            'hr_approved' => true,
                            'hr_reason' => $data['hr_reason'],
                            'hr_action_at' => now(),
                            'hr_actor_email' => Filament::auth()->user()?->email,
                        ]);

                        // إرسال نوتفيكشن للموظف بالموافقة النهائية
                        $record->user?->notify(new TicketFinalApprovedNotification($record));

                        // إرسال نوتفيكشن للمدير
                        self::notifyPanelUsers('manager', new TicketFinalApprovedNotification($record));

                        // إرسال نوتفيكشن للادمن
                        self::notifyPanelUsers('admin', new TicketFinalApprovedNotification($record));

                        Notification::make()->title('تم الموافقة من HR')->success()->send();
                    }),

                Action::make('hr_reject')
                    ->label('رفض HR')
                    ->color('danger')
                    ->icon('heroicon-o-no-symbol')
                    ->visible(fn(Ticket $record) => PanelContext::is('hr') && $record->status === TicketStatus::PendingHr)
                    ->form([
                        Textarea::make('hr_reason')->label('سبب الرفض')->required()->rows(3),
                    ])
                    ->requiresConfirmation()
                    ->action(function (Ticket $record, array $data) {
                        $record->update([
                            'status' => TicketStatus::Rejected,
                            'hr_approved' => false,
                            'hr_reason' => $data['hr_reason'],
                            'hr_action_at' => now(),
                            'hr_actor_email' => Filament::auth()->user()?->email,
                        ]);

                        // إرسال نوتفيكشن للموظف بالرفض
                        $record->user?->notify(new TicketRejectedNotification($record, 'hr'));

                        // إرسال نوتفيكشن للمدير
                        self::notifyPanelUsers('manager', new TicketRejectedNotification($record, 'hr'));

                        // إرسال نوتفيكشن للادمن
                        self::notifyPanelUsers('admin', new TicketRejectedNotification($record, 'hr'));

                        Notification::make()->title('تم الرفض من HR')->danger()->send();
                    }),

                // employee يقدر يعدل قبل ما المدير يشوفها (pending_manager)
                EditAction::make()
                    ->visible(
                        fn(Ticket $record) =>
                        PanelContext::is('admin')
                            || (PanelContext::is('employee') && $record->status === TicketStatus::PendingManager)
                    ),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn() => PanelContext::is('admin')),
                ]),
            ]);
    }

    protected static function notifyPanelUsers(string $panelId, \Illuminate\Notifications\Notification $notification): void
    {
        $users = User::query()->where('default_panel', $panelId)->get();
        if ($users->isNotEmpty()) {
            LaravelNotification::send($users, $notification);
        }
    }
}
