<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\View;
use Spatie\Permission\Models\Permission;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        $record = $schema->getRecord();
        return $schema
            ->components([
                TextInput::make('name')
                    ->columnSpanFull()
                    ->required()
                    ->unique(ignoreRecord: true),
                Hidden::make('guard_name')
                    ->default('web'),
                Hidden::make('permissions')
                    ->default([]),
                View::make('filament.components.permission-matrix')
                    ->columnSpanFull()
                    ->viewData([
                        'permissions' => Permission::all()->pluck('name')->toArray(),
                        'selected' => $record ? $record->permissions->pluck('name')->toArray() : [],
                        'readonly' => false,
                    ]),
            ]);
    }
}
