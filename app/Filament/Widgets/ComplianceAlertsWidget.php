<?php

namespace App\Filament\Widgets;

use App\Models\ComplianceAlert;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class ComplianceAlertsWidget extends TableWidget
{
    protected static ?string $heading = 'Recent compliance alerts';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ComplianceAlert::query()->latest('detected_at')->limit(8)
            )
            ->columns([
                TextColumn::make('severity')->badge(),
                TextColumn::make('title')->searchable()->wrap(),
                TextColumn::make('alert_type')->label('Type'),
                TextColumn::make('status')->badge(),
                TextColumn::make('detected_at')->dateTime()->since(),
            ])
            ->paginated(false);
    }
}
