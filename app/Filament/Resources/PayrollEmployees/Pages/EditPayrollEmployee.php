<?php

namespace App\Filament\Resources\PayrollEmployees\Pages;

use App\Filament\Resources\PayrollEmployees\PayrollEmployeeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPayrollEmployee extends EditRecord
{
    protected static string $resource = PayrollEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
