<?php

namespace App\Services;

use App\Models\OvertimeRule;
use App\Models\PayrollEmployee;

class OvertimeCalculator
{
    /**
     * @return array{regular_hours: float, ot_hours: float, ot_pay: float, multiplier: float}
     */
    public function evaluate(PayrollEmployee $employee, float $hoursWorked): array
    {
        $rule = OvertimeRule::query()
            ->where('jurisdiction_id', $employee->jurisdiction_id)
            ->where('is_active', true)
            ->orderByDesc('priority')
            ->first();

        $weeklyThreshold = (float) ($rule?->weekly_threshold_hours ?? 40);
        $multiplier = (float) ($rule?->overtime_multiplier ?? 1.5);
        $rate = (float) $employee->hourly_rate;

        $otHours = max(0, $hoursWorked - $weeklyThreshold);
        $regularHours = min($hoursWorked, $weeklyThreshold);

        return [
            'regular_hours' => round($regularHours, 2),
            'ot_hours' => round($otHours, 2),
            'ot_pay' => round($otHours * $rate * $multiplier, 2),
            'multiplier' => $multiplier,
        ];
    }
}
