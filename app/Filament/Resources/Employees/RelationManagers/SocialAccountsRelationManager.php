<?php

namespace App\Filament\Resources\Employees\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SocialAccountsRelationManager extends RelationManager
{
    protected static string $relationship = 'socialAccounts';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
            Select::make('platform')
                ->required()
                ->options([
                    'facebook'  => 'Facebook',
                    'linkedin'  => 'LinkedIn',
                    'gmail'     => 'Gmail',
                    'instagram' => 'Instagram',
                    'desktop'   => 'Desktop',
                    'other'     => 'Other',
                ])
                ->searchable(),

            TextInput::make('username')
                ->label('Username')
                ->nullable(),

            TextInput::make('email')
                ->email()
                ->nullable(),

            TextInput::make('url')
                ->label('Profile URL')
                ->url()
                ->nullable(),

            TextInput::make('password_hint')
                ->label('Password Hint')
                ->helperText('Never store real passwords')
                ->nullable(),

            Textarea::make('notes')
                ->rows(3)
                ->nullable(),

            Select::make('status')
                ->options([
                    'active' => 'Active',
                    'disabled' => 'Disabled',
                ])
                ->default('active')
                ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
            TextColumn::make('platform')
                ->badge()
                ->sortable(),

            TextColumn::make('username')
                ->toggleable(),

            TextColumn::make('email')
                ->toggleable(),

            TextColumn::make('url')
                ->limit(30)
                ->toggleable(),

            BadgeColumn::make('status')
                ->colors([
                    'success' => 'active',
                    'danger'  => 'disabled',
                ]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
