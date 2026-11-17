<?php

namespace App\Filament\Resources\PayrollEmployees\Pages;

use App\Filament\Resources\PayrollEmployees\PayrollEmployeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePayrollEmployee extends CreateRecord
{
    protected static string $resource = PayrollEmployeeResource::class;
}
