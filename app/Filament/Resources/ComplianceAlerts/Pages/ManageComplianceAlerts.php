<?php

namespace App\Filament\Resources\ComplianceAlerts\Pages;

use App\Filament\Resources\ComplianceAlerts\ComplianceAlertResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageComplianceAlerts extends ManageRecords
{
    protected static string $resource = ComplianceAlertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
