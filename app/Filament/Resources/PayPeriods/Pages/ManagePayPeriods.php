<?php

namespace App\Filament\Resources\PayPeriods\Pages;

use App\Filament\Resources\PayPeriods\PayPeriodResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePayPeriods extends ManageRecords
{
    protected static string $resource = PayPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
