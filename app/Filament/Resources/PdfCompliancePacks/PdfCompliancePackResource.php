<?php

namespace App\Filament\Resources\PdfCompliancePacks;

use App\Filament\Resources\PdfCompliancePacks\Pages\CreatePdfCompliancePack;
use App\Filament\Resources\PdfCompliancePacks\Pages\EditPdfCompliancePack;
use App\Filament\Resources\PdfCompliancePacks\Pages\ListPdfCompliancePacks;
use App\Filament\Resources\PdfCompliancePacks\Schemas\PdfCompliancePackForm;
use App\Filament\Resources\PdfCompliancePacks\Tables\PdfCompliancePacksTable;
use App\Models\PdfCompliancePack;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PdfCompliancePackResource extends Resource
{
    protected static ?string $model = PdfCompliancePack::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentArrowDown;

    protected static string|UnitEnum|null $navigationGroup = 'Reporting';

    protected static ?int $navigationSort = 80;

    protected static ?string $navigationLabel = 'PDF Packs';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('pdf_packs');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return PdfCompliancePackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PdfCompliancePacksTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPdfCompliancePacks::route('/'),
            'create' => CreatePdfCompliancePack::route('/create'),
            'edit' => EditPdfCompliancePack::route('/{record}/edit'),
        ];
    }
}
