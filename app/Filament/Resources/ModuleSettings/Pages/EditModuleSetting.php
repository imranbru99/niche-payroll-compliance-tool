<?php

namespace App\Filament\Resources\ModuleSettings\Pages;

use App\Filament\Resources\ModuleSettings\ModuleSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModuleSetting extends EditRecord
{
    protected static string $resource = ModuleSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
