<?php

namespace App\Filament\Resources\PdfCompliancePacks\Pages;

use App\Filament\Resources\PdfCompliancePacks\PdfCompliancePackResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePdfCompliancePacks extends ManageRecords
{
    protected static string $resource = PdfCompliancePackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
