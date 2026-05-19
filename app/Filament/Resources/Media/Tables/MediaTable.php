<?php

namespace App\Filament\Resources\Media\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Tables\Filters\TrashedFilter;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('S.No.')
                    ->rowIndex(),
                ImageColumn::make('thumbnail_path')
                    ->label('Preview')
                    ->disk('public')
                    ->height(100)
                    ->width(100)
                    ->defaultImageUrl(
                        fn($record) => $record->thumbnail_path
                            ? Storage::disk('public')->url($record->thumbnail_path)
                            : Storage::disk('public')->url($record->path)
                    ),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'image'    => 'success',
                        'video'    => 'warning',
                        'document' => 'info',
                        default    => 'gray',
                    }),
                TextColumn::make('mime_type')
                    ->label('Format')
                    ->searchable(),
                TextColumn::make('size')
                    ->label('Size')
                    ->formatStateUsing(
                        fn($state) =>
                        $state >= 1048576
                            ? round($state / 1048576, 2) . ' MB'
                            : round($state / 1024, 2) . ' KB'
                    ),
                TextColumn::make('uploader.name')
                    ->label('Uploaded by')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Uploaded')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                \Filament\Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('type')
                    ->options([
                        'image'    => 'Image',
                        'video'    => 'Video',
                        'document' => 'Document',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->authorize(fn() => auth()->user()?->hasRole('admin') ||
                        auth()->user()?->can('edit media')),
                RestoreAction::make()
                    ->authorize(fn() => auth()->user()?->hasRole('admin') ||
                        auth()->user()?->can('delete media')),
                DeleteAction::make()
                    ->authorize(fn() => auth()->user()?->hasRole('admin') ||
                        auth()->user()?->can('delete media')),
                ForceDeleteAction::make()
                    ->authorize(fn() => auth()->user()?->hasRole('admin') ||
                        auth()->user()?->can('delete media')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->authorize(fn() => auth()->user()?->hasRole('admin') ||
                            auth()->user()?->can('delete media')),
                    RestoreBulkAction::make()
                        ->authorize(fn() => auth()->user()?->hasRole('admin') ||
                            auth()->user()?->can('delete media')),
                    ForceDeleteBulkAction::make()
                        ->authorize(fn() => auth()->user()?->hasRole('admin') ||
                            auth()->user()?->can('delete media')),
                ]),
            ]);
    }
}
