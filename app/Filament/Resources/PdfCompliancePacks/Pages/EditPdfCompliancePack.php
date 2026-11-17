<?php

namespace App\Filament\Resources\PdfCompliancePacks\Pages;

use App\Filament\Resources\PdfCompliancePacks\PdfCompliancePackResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPdfCompliancePack extends EditRecord
{
    protected static string $resource = PdfCompliancePackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
