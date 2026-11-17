<?php

namespace App\Filament\Widgets;

use App\Models\ComplianceAlert;
use App\Services\ModuleManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class OpenAlertsWidget extends TableWidget
{
    protected static ?string $heading = 'Open compliance alerts';

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return app(ModuleManager::class)->enabled('alerts');
    }

    protected function getTableQuery(): Builder
    {
        return ComplianceAlert::query()
            ->with('jurisdiction')
            ->where('status', 'open')
            ->latest('detected_at');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('title')->limit(48),
                TextColumn::make('alert_type')->badge(),
                TextColumn::make('severity')->badge(),
                TextColumn::make('jurisdiction.name')->placeholder('—'),
                TextColumn::make('detected_at')->dateTime(),
            ])
            ->paginated([5]);
    }
}
