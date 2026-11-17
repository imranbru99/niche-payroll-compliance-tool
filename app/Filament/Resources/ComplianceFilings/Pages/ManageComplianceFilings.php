<?php

namespace App\Filament\Resources\ComplianceFilings\Pages;

use App\Filament\Resources\ComplianceFilings\ComplianceFilingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageComplianceFilings extends ManageRecords
{
    protected static string $resource = ComplianceFilingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
