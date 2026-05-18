<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MediaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('path')
                    ->label('Preview')
                    ->disk('public')
                    ->height(200)
                    ->columnSpanFull(),
                TextEntry::make('name')
                    ->label('Name'),
                TextEntry::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'image'    => 'success',
                        'video'    => 'warning',
                        'document' => 'info',
                        default    => 'gray',
                    }),
                TextEntry::make('mime_type')
                    ->label('Format'),
                TextEntry::make('size')
                    ->label('Size')
                    ->formatStateUsing(
                        fn($state) =>
                        $state >= 1048576
                            ? round($state / 1048576, 2) . ' MB'
                            : round($state / 1024, 2) . ' KB'
                    ),
                TextEntry::make('uploader.name')
                    ->label('Uploaded by'),
                TextEntry::make('alt')
                    ->label('Alt Text')
                    ->placeholder('—'),
                TextEntry::make('caption')
                    ->label('Caption')
                    ->placeholder('—')
                    ->columnSpanFull(),
                TextEntry::make('path')
                    ->label('File URL')
                    ->formatStateUsing(fn($state, $record) => $record->url)
                    ->copyable()
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Uploaded at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->label('Updated at')
                    ->dateTime(),
            ]);
    }
}
