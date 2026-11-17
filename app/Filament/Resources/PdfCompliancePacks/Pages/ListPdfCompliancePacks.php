<?php

namespace App\Filament\Resources\PdfCompliancePacks\Pages;

use App\Filament\Resources\PdfCompliancePacks\PdfCompliancePackResource;
use Filament\Resources\Pages\ListRecords;

class ListPdfCompliancePacks extends ListRecords
{
    protected static string $resource = PdfCompliancePackResource::class;
}
