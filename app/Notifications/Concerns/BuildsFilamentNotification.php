<?php

namespace App\Notifications\Concerns;

use Filament\Actions\Action;

trait BuildsFilamentNotification
{
    protected function buildFilamentDatabaseNotification(array $data, string $url): array
    {
        return [
            ...$data,
            'format' => 'filament',
            'duration' => 'persistent',
            'actions' => [
                Action::make('view_ticket')
                    ->label('عرض الطلب')
                    ->url($url)
                    ->markAsRead()
                    ->toArray(),
            ],
        ];
    }
}
