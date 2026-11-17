<?php

namespace App\Filament\Resources\PayPeriods;

use App\Filament\Resources\PayPeriods\Pages\CreatePayPeriod;
use App\Filament\Resources\PayPeriods\Pages\EditPayPeriod;
use App\Filament\Resources\PayPeriods\Pages\ListPayPeriods;
use App\Filament\Resources\PayPeriods\Schemas\PayPeriodForm;
use App\Filament\Resources\PayPeriods\Tables\PayPeriodsTable;
use App\Models\PayPeriod;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PayPeriodResource extends Resource
{
    protected static ?string $model = PayPeriod::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|UnitEnum|null $navigationGroup = 'Payroll';

    protected static ?int $navigationSort = 50;

    protected static ?string $navigationLabel = 'Pay Periods';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('pay_periods');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return PayPeriodForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PayPeriodsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPayPeriods::route('/'),
            'create' => CreatePayPeriod::route('/create'),
            'edit' => EditPayPeriod::route('/{record}/edit'),
        ];
    }
}
