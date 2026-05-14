<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\View;
use Spatie\Permission\Models\Permission;

class RoleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        $record = $schema->getRecord();

        return $schema
            ->components([
                TextEntry::make('name')
                    ->columnSpanFull()
                    ->label('Role Name'),
                View::make('filament.components.permission-matrix')
                    ->columnSpanFull()
                    ->viewData([
                        'permissions' => Permission::all()->pluck('name')->toArray(),
                        'selected' => $record ? $record->permissions->pluck('name')->toArray() : [],
                        'readonly' => true,
                    ]),
            ]);
    }
}
