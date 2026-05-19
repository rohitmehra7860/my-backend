<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('path')
                    ->label('Upload Files')
                    ->disk('public')
                    ->directory('media/' . date('Y/m'))
                    ->acceptedFileTypes(['image/*', 'video/*', 'application/pdf'])
                    ->maxSize(102400)
                    ->imageEditor()
                    ->multiple(fn(string $operation): bool => $operation === 'create')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('name')
                    ->label('Name')
                    ->default('untitled')
                    ->columnSpanFull(),
                TextInput::make('alt')
                    ->label('Alt Text')
                    ->columnSpanFull(),
                Textarea::make('caption')
                    ->label('Caption')
                    ->columnSpanFull(),
            ]);
    }
}
