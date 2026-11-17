<?php

namespace App\Filament\Resources\ModuleSettings;

use App\Filament\Resources\ModuleSettings\Pages\CreateModuleSetting;
use App\Filament\Resources\ModuleSettings\Pages\EditModuleSetting;
use App\Filament\Resources\ModuleSettings\Pages\ListModuleSettings;
use App\Filament\Resources\ModuleSettings\Schemas\ModuleSettingForm;
use App\Filament\Resources\ModuleSettings\Tables\ModuleSettingsTable;
use App\Models\ModuleSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ModuleSettingResource extends Resource
{
    protected static ?string $model = ModuleSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Platform';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Modules';

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function form(Schema $schema): Schema
    {
        return ModuleSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModuleSettingsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModuleSettings::route('/'),
            'create' => CreateModuleSetting::route('/create'),
            'edit' => EditModuleSetting::route('/{record}/edit'),
        ];
    }
}
