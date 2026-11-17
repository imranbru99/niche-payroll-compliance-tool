<?php

namespace App\Filament\Resources\ComplianceFilings;

use App\Filament\Resources\ComplianceFilings\Pages\CreateComplianceFiling;
use App\Filament\Resources\ComplianceFilings\Pages\EditComplianceFiling;
use App\Filament\Resources\ComplianceFilings\Pages\ListComplianceFilings;
use App\Filament\Resources\ComplianceFilings\Schemas\ComplianceFilingForm;
use App\Filament\Resources\ComplianceFilings\Tables\ComplianceFilingsTable;
use App\Models\ComplianceFiling;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ComplianceFilingResource extends Resource
{
    protected static ?string $model = ComplianceFiling::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'Compliance';

    protected static ?int $navigationSort = 60;

    protected static ?string $navigationLabel = 'Filings';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('filings');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return ComplianceFilingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComplianceFilingsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComplianceFilings::route('/'),
            'create' => CreateComplianceFiling::route('/create'),
            'edit' => EditComplianceFiling::route('/{record}/edit'),
        ];
    }
}
