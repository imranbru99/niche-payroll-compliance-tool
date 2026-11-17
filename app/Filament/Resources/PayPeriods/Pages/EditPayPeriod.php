<?php

namespace App\Filament\Resources\PayPeriods\Pages;

use App\Filament\Resources\PayPeriods\PayPeriodResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPayPeriod extends EditRecord
{
    protected static string $resource = PayPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
