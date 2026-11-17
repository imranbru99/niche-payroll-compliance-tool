<?php

namespace App\Filament\Resources\Jurisdictions;

use App\Filament\Resources\Jurisdictions\Pages\CreateJurisdiction;
use App\Filament\Resources\Jurisdictions\Pages\EditJurisdiction;
use App\Filament\Resources\Jurisdictions\Pages\ListJurisdictions;
use App\Filament\Resources\Jurisdictions\Schemas\JurisdictionForm;
use App\Filament\Resources\Jurisdictions\Tables\JurisdictionsTable;
use App\Models\Jurisdiction;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JurisdictionResource extends Resource
{
    protected static ?string $model = Jurisdiction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAmericas;

    protected static string|UnitEnum|null $navigationGroup = 'Compliance';

    protected static ?int $navigationSort = 10;

    protected static ?string $navigationLabel = 'Jurisdictions';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('jurisdictions');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return JurisdictionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JurisdictionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJurisdictions::route('/'),
            'create' => CreateJurisdiction::route('/create'),
            'edit' => EditJurisdiction::route('/{record}/edit'),
        ];
    }
}
