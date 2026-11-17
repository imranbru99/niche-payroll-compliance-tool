<?php

namespace App\Filament\Resources\PayrollEmployees;

use App\Filament\Resources\PayrollEmployees\Pages\CreatePayrollEmployee;
use App\Filament\Resources\PayrollEmployees\Pages\EditPayrollEmployee;
use App\Filament\Resources\PayrollEmployees\Pages\ListPayrollEmployees;
use App\Filament\Resources\PayrollEmployees\Schemas\PayrollEmployeeForm;
use App\Filament\Resources\PayrollEmployees\Tables\PayrollEmployeesTable;
use App\Models\PayrollEmployee;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PayrollEmployeeResource extends Resource
{
    protected static ?string $model = PayrollEmployee::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static string|UnitEnum|null $navigationGroup = 'Workforce';

    protected static ?int $navigationSort = 40;

    protected static ?string $navigationLabel = 'Employees';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('employees');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return PayrollEmployeeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PayrollEmployeesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPayrollEmployees::route('/'),
            'create' => CreatePayrollEmployee::route('/create'),
            'edit' => EditPayrollEmployee::route('/{record}/edit'),
        ];
    }
}
