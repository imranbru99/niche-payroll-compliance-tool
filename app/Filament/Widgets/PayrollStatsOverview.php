<?php

namespace App\Filament\Widgets;

use App\Models\ComplianceAlert;
use App\Models\ComplianceFiling;
use App\Models\PayrollEmployee;
use App\Models\PayPeriod;
use App\Services\ModuleManager;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PayrollStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $hours = app(ModuleManager::class)->weeklyHoursSaved();

        return [
            Stat::make('Active Employees', PayrollEmployee::query()->where('status', 'active')->count())
                ->description('Roster under compliance control')
                ->color('primary'),
            Stat::make('Open Alerts', ComplianceAlert::query()->where('status', 'open')->count())
                ->description('OT, filing, and classification risk')
                ->color('danger'),
            Stat::make('Pending Filings', ComplianceFiling::query()->whereIn('status', ['draft', 'in_progress'])->count())
                ->description('Due or in progress this cycle')
                ->color('warning'),
            Stat::make('Pay Periods', PayPeriod::query()->count())
                ->description("{$hours} hrs/week estimated capacity")
                ->color('success'),
        ];
    }
}
