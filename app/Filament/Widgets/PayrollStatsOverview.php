<?php

namespace App\Filament\Widgets;

use App\Models\ComplianceAlert;
use App\Models\ComplianceFiling;
use App\Models\Jurisdiction;
use App\Models\PayPeriod;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PayrollStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $openAlerts = ComplianceAlert::query()->where('status', 'open')->count();
        $dueFilings = ComplianceFiling::query()
            ->whereIn('status', ['draft', 'in_progress'])
            ->count();
        $openPeriods = PayPeriod::query()->where('status', 'open')->count();
        $jurisdictions = Jurisdiction::query()->where('is_active', true)->count();

        return [
            Stat::make('Open Compliance Alerts', $openAlerts)
                ->description('OT, misclass, and late-filing risk')
                ->color('danger'),
            Stat::make('Filings In Progress', $dueFilings)
                ->description('Draft or in-progress submissions')
                ->color('warning'),
            Stat::make('Open Pay Periods', $openPeriods)
                ->description('Active payroll calendars')
                ->color('primary'),
            Stat::make('Active Jurisdictions', $jurisdictions)
                ->description('Wage & OT rule coverage')
                ->color('success'),
        ];
    }
}
