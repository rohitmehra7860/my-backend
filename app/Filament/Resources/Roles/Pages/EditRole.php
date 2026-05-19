<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Resources\Roles\RoleResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->authorize(fn() => auth()->user()?->hasRole('admin') ||
                    auth()->user()?->can('delete roles')),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['permissions'] = $this->record->permissions->pluck('name')->toArray();
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->permissionsToSync = $data['permissions'] ?? [];
        unset($data['permissions']);
        return $data;
    }

    protected function afterSave(): void
    {
        if (isset($this->permissionsToSync)) {
            $this->record->syncPermissions($this->permissionsToSync);
        }
        // This triggers a hard browser reload right after the sync completes
        $this->js('window.location.reload();');
    }
}
