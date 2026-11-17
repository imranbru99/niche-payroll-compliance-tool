<?php

namespace App\Filament\Resources\PayrollEmployees\Pages;

use App\Filament\Resources\PayrollEmployees\PayrollEmployeeResource;
use Filament\Resources\Pages\ListRecords;

class ListPayrollEmployees extends ListRecords
{
    protected static string $resource = PayrollEmployeeResource::class;
}
