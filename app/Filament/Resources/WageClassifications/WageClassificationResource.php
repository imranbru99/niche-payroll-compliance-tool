<?php

namespace App\Filament\Resources\WageClassifications;

use App\Filament\Resources\WageClassifications\Pages\CreateWageClassification;
use App\Filament\Resources\WageClassifications\Pages\EditWageClassification;
use App\Filament\Resources\WageClassifications\Pages\ListWageClassifications;
use App\Filament\Resources\WageClassifications\Schemas\WageClassificationForm;
use App\Filament\Resources\WageClassifications\Tables\WageClassificationsTable;
use App\Models\WageClassification;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class WageClassificationResource extends Resource
{
    protected static ?string $model = WageClassification::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string|UnitEnum|null $navigationGroup = 'Payroll';

    protected static ?int $navigationSort = 20;

    protected static ?string $navigationLabel = 'Wage Classes';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('wage_classes');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return WageClassificationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WageClassificationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWageClassifications::route('/'),
            'create' => CreateWageClassification::route('/create'),
            'edit' => EditWageClassification::route('/{record}/edit'),
        ];
    }
}
