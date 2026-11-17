<?php

namespace App\Filament\Resources\PayrollEmployees\Pages;

use App\Filament\Resources\PayrollEmployees\PayrollEmployeeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePayrollEmployees extends ManageRecords
{
    protected static string $resource = PayrollEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
