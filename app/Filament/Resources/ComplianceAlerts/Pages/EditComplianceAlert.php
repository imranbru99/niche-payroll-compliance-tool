<?php

namespace App\Filament\Resources\ComplianceAlerts\Pages;

use App\Filament\Resources\ComplianceAlerts\ComplianceAlertResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditComplianceAlert extends EditRecord
{
    protected static string $resource = ComplianceAlertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
