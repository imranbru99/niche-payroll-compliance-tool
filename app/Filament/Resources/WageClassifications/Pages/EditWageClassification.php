<?php

namespace App\Filament\Resources\WageClassifications\Pages;

use App\Filament\Resources\WageClassifications\WageClassificationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWageClassification extends EditRecord
{
    protected static string $resource = WageClassificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
