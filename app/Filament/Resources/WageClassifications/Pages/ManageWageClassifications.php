<?php

namespace App\Filament\Resources\WageClassifications\Pages;

use App\Filament\Resources\WageClassifications\WageClassificationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageWageClassifications extends ManageRecords
{
    protected static string $resource = WageClassificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
