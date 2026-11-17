<?php

namespace App\Filament\Resources\PayrollRuns\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PayrollRunsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')->searchable()->sortable(),
                TextColumn::make('regular_hours')->searchable()->sortable(),
                TextColumn::make('ot_hours')->searchable()->sortable(),
                TextColumn::make('gross_pay')->searchable()->sortable(),
                TextColumn::make('ot_pay')->searchable()->sortable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
