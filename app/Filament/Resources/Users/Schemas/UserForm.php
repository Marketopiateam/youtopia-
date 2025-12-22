<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        $guard = Filament::getCurrentPanel()?->getAuthGuard() ?? 'web';
        return $schema
            ->components([
                Section::make('User Info')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $operation) => $operation === 'create')
                            ->columnSpanFull(),
                    ]),

                Section::make('Access / Roles')
                    ->schema([
                        Select::make('roles')
                            ->label('Roles')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->options(
                                fn() => Role::query()
                                    ->where('guard_name', $guard)
                                    ->orderBy('name')
                                    ->pluck('name', 'name')
                                    ->toArray()
                            )
                            ->helperText('Assign roles to control access to panels (admin / hr / manager / employee).')
                            ->dehydrated(false)
                            ->afterStateHydrated(function (Select $component, ?User $record) {
                                if (! $record) return;
                                $component->state($record->getRoleNames()->values()->all());
                            })
                            ->saveRelationshipsUsing(function (Select $component, User $record, $state) {
                                $state = is_array($state) ? $state : [];
                                $record->syncRoles($state);
                            }),
                    ]),
            ]);
    }
}
