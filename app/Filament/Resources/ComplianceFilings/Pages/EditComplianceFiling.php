<?php

namespace App\Filament\Resources\ComplianceFilings\Pages;

use App\Filament\Resources\ComplianceFilings\ComplianceFilingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditComplianceFiling extends EditRecord
{
    protected static string $resource = ComplianceFilingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
