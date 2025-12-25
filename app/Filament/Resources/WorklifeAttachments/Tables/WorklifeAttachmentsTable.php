<?php

namespace App\Filament\Resources\WorklifeAttachments\Tables;

use App\Models\WorklifeComment;
use App\Models\WorklifePost;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class WorklifeAttachmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('file_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('attachable_type')
                    ->label('Attachable type')
                    ->badge(),
                TextColumn::make('attachable_id')
                    ->label('Attachable ID')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('mime_type')
                    ->placeholder('-'),
                TextColumn::make('file_size')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('uploader.employee_code')
                    ->label('Uploaded by')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('attachable_type')
                    ->label('Attachable type')
                    ->options([
                        WorklifePost::class => 'Worklife Post',
                        WorklifeComment::class => 'Worklife Comment',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
