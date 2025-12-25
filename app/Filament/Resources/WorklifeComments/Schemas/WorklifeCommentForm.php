<?php

namespace App\Filament\Resources\WorklifeComments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WorklifeCommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('post_id')
                    ->label('Post')
                    ->relationship('post', 'id')
                    ->searchable()
                    ->required(),
                Select::make('author_user_id')
                    ->label('Author')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->required(),
                Select::make('parent_comment_id')
                    ->label('Parent comment')
                    ->relationship('parent', 'id')
                    ->searchable(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
