<?php

namespace App\Filament\Resources\GoalLinks\Schemas;

use App\Enums\GoalType;
use App\Models\CompanyGoal;
use App\Models\DepartmentGoal;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Schemas\Schema;

class GoalLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('goal_type')
                    ->options(GoalType::class)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('goal_id', null)),
                Select::make('goal_id')
                    ->label('Goal')
                    ->required()
                    ->searchable()
                    ->options(function (Get $get): array {
                        $goalType = $get('goal_type');

                        if ($goalType === GoalType::Company->value) {
                            return CompanyGoal::query()
                                ->orderBy('title')
                                ->pluck('title', 'id')
                                ->all();
                        }

                        if ($goalType === GoalType::Department->value) {
                            return DepartmentGoal::query()
                                ->orderBy('title')
                                ->pluck('title', 'id')
                                ->all();
                        }

                        return [];
                    }),
                Select::make('objective_id')
                    ->relationship('objective', 'title')
                    ->required()
                    ->searchable(),
            ]);
    }
}
