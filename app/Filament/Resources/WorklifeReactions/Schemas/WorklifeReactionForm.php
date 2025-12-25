<?php

namespace App\Filament\Resources\WorklifeReactions\Schemas;

use App\Enums\ReactionType;
use App\Models\WorklifeComment;
use App\Models\WorklifePost;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WorklifeReactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reactable_type')
                    ->label('Reactable type')
                    ->options([
                        WorklifePost::class => 'Worklife Post',
                        WorklifeComment::class => 'Worklife Comment',
                    ])
                    ->required(),
                TextInput::make('reactable_id')
                    ->label('Reactable ID')
                    ->numeric()
                    ->required(),
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('reaction_type')
                    ->options(ReactionType::class)
                    ->required(),
            ]);
    }
}
