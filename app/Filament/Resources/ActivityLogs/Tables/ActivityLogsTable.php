<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('S.No.')
                    ->rowIndex(),
                TextColumn::make('causer.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn($state) => class_basename($state))
                    ->sortable(),
                TextColumn::make('event')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('When')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
