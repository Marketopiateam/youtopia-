<?php

namespace App\Filament\Resources\WorklifePosts\Schemas;

use App\Models\WorklifePost;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WorklifePostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('author_employee_id')
                    ->numeric(),
                TextEntry::make('source_type')
                    ->placeholder('-'),
                TextEntry::make('source_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('post_type')
                    ->badge(),
                TextEntry::make('content')
                    ->columnSpanFull(),
                TextEntry::make('audience_type')
                    ->badge(),
                TextEntry::make('audience_id')
                    ->numeric()
                    ->placeholder('-'),
                IconEntry::make('is_pinned')
                    ->boolean(),
                TextEntry::make('published_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (WorklifePost $record): bool => $record->trashed()),
            ]);
    }
}
