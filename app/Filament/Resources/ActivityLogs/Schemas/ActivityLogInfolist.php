<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActivityLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('causer.name')
                    ->label('User'),
                TextEntry::make('description')
                    ->label('Action'),
                TextEntry::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn($state) => class_basename($state)),
                TextEntry::make('event')
                    ->label('Event')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('properties')
                    ->label('Changes')
                    ->formatStateUsing(fn($state) => json_encode($state, JSON_PRETTY_PRINT)),
                TextEntry::make('created_at')
                    ->label('When')
                    ->dateTime(),
            ]);
    }
}
