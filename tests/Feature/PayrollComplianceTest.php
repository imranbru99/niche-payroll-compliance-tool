<?php

namespace Tests\Feature;

use App\Models\Jurisdiction;
use App\Models\OvertimeRule;
use App\Models\PayrollEmployee;
use App\Services\OvertimeCalculator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PayrollComplianceTest extends TestCase
{
    use RefreshDatabase;

    public function test_overtime_calculator_applies_weekly_threshold(): void
    {
        $jurisdiction = Jurisdiction::query()->create([
            'code' => 'US-DEMO',
            'name' => 'Demo State',
            'country_code' => 'US',
            'currency_code' => 'USD',
            'is_active' => true,
        ]);

        OvertimeRule::query()->create([
            'jurisdiction_id' => $jurisdiction->id,
            'name' => 'Demo OT',
            'slug' => 'demo-ot',
            'weekly_threshold_hours' => 40,
            'overtime_multiplier' => 1.5,
            'priority' => 100,
            'is_active' => true,
        ]);

        $employee = PayrollEmployee::query()->create([
            'employee_number' => 'E-1',
            'full_name' => 'Test Worker',
            'jurisdiction_id' => $jurisdiction->id,
            'hourly_rate' => 20,
            'status' => 'active',
        ]);

        $result = app(OvertimeCalculator::class)->evaluate($employee, 46);

        $this->assertSame(40.0, $result['regular_hours']);
        $this->assertSame(6.0, $result['ot_hours']);
        $this->assertSame(180.0, $result['ot_pay']);
    }
}
