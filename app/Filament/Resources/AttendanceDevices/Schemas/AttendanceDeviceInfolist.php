<?php

namespace App\Filament\Resources\AttendanceDevices\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AttendanceDeviceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('location')
                    ->placeholder('-'),
                TextEntry::make('device_id')
                    ->label('Device ID'),
                TextEntry::make('is_active')
                    ->label('Active')
                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
