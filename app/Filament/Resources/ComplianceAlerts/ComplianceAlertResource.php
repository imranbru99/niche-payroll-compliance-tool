<?php

namespace App\Filament\Resources\ComplianceAlerts;

use App\Filament\Resources\ComplianceAlerts\Pages\CreateComplianceAlert;
use App\Filament\Resources\ComplianceAlerts\Pages\EditComplianceAlert;
use App\Filament\Resources\ComplianceAlerts\Pages\ListComplianceAlerts;
use App\Filament\Resources\ComplianceAlerts\Schemas\ComplianceAlertForm;
use App\Filament\Resources\ComplianceAlerts\Tables\ComplianceAlertsTable;
use App\Models\ComplianceAlert;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ComplianceAlertResource extends Resource
{
    protected static ?string $model = ComplianceAlert::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBellAlert;

    protected static string|UnitEnum|null $navigationGroup = 'Risk';

    protected static ?int $navigationSort = 70;

    protected static ?string $navigationLabel = 'Alerts';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('alerts');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return ComplianceAlertForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComplianceAlertsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComplianceAlerts::route('/'),
            'create' => CreateComplianceAlert::route('/create'),
            'edit' => EditComplianceAlert::route('/{record}/edit'),
        ];
    }
}
