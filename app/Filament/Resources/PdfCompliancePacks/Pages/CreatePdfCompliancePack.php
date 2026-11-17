<?php

namespace App\Filament\Resources\PdfCompliancePacks\Pages;

use App\Filament\Resources\PdfCompliancePacks\PdfCompliancePackResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePdfCompliancePack extends CreateRecord
{
    protected static string $resource = PdfCompliancePackResource::class;
}
