<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\ComplianceAlert;
use App\Models\ComplianceFiling;
use App\Models\Jurisdiction;
use App\Models\OvertimeRule;
use App\Models\PayPeriod;
use App\Models\PayrollEmployee;
use App\Models\PayrollRun;
use App\Models\PdfCompliancePack;
use App\Models\User;
use App\Models\WageClassification;
use App\Services\ModuleManager;
use App\Services\OvertimeCalculator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $users = $this->seedUsers();
        app(ModuleManager::class)->syncFromConfig();

        $jurisdictions = $this->seedJurisdictions();
        $classes = $this->seedWageClasses($jurisdictions);
        $this->seedOvertimeRules($jurisdictions);
        $employees = $this->seedEmployees($jurisdictions, $classes, $users);
        $periods = $this->seedPayPeriods($jurisdictions, $employees);
        $this->seedFilings($jurisdictions, $periods, $users);
        $this->seedAlerts($jurisdictions, $employees);
        $this->seedPdfPacks($jurisdictions, $periods, $users);
    }

    /** @return array<string, User> */
    protected function seedUsers(): array
    {
        $password = config('payroll.demo.password', 'password');

        $defs = [
            'super' => ['name' => 'Imran Ahmed', 'email' => 'admin@payroll-compliance.test', 'role' => UserRole::SuperAdmin, 'org' => 'ImranDev BD', 'title' => 'Platform Architect'],
            'admin' => ['name' => 'Sara Khan', 'email' => 'payroll-admin@payroll-compliance.test', 'role' => UserRole::Admin, 'org' => 'PayComply Ops', 'title' => 'Payroll Admin'],
            'manager' => ['name' => 'Jamal Uddin', 'email' => 'manager@payroll-compliance.test', 'role' => UserRole::Manager, 'org' => 'PayComply Ops', 'title' => 'Compliance Manager'],
            'staff' => ['name' => 'Lina Chowdhury', 'email' => 'staff@payroll-compliance.test', 'role' => UserRole::Staff, 'org' => 'PayComply Ops', 'title' => 'Payroll Specialist'],
            'client' => ['name' => 'Horizon Manufacturing', 'email' => 'client@payroll-compliance.test', 'role' => UserRole::Client, 'org' => 'Horizon Mfg', 'title' => 'HR Lead'],
            'demo' => ['name' => 'Demo User', 'email' => config('payroll.demo.email'), 'role' => UserRole::Demo, 'org' => 'Demo Co', 'title' => 'Evaluator'],
        ];

        $users = [];
        foreach ($defs as $key => $def) {
            $users[$key] = User::query()->updateOrCreate(
                ['email' => $def['email']],
                [
                    'name' => $def['name'],
                    'password' => $password,
                    'role' => $def['role'],
                    'organization_name' => $def['org'],
                    'job_title' => $def['title'],
                    'phone' => '+88015'.random_int(10000000, 99999999),
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }

        return $users;
    }

    /** @return array<string, Jurisdiction> */
    protected function seedJurisdictions(): array
    {
        $defs = [
            ['code' => 'US-CA', 'name' => 'California', 'country_code' => 'US', 'region' => 'West', 'authority_name' => 'DIR / DLSE', 'currency_code' => 'USD', 'minimum_wage' => 16.00],
            ['code' => 'US-NY', 'name' => 'New York', 'country_code' => 'US', 'region' => 'Northeast', 'authority_name' => 'NY DOL', 'currency_code' => 'USD', 'minimum_wage' => 15.00],
            ['code' => 'US-TX', 'name' => 'Texas', 'country_code' => 'US', 'region' => 'South', 'authority_name' => 'TWC', 'currency_code' => 'USD', 'minimum_wage' => 7.25],
            ['code' => 'BD-DH', 'name' => 'Dhaka Division', 'country_code' => 'BD', 'region' => 'Dhaka', 'authority_name' => 'DIFE', 'currency_code' => 'BDT', 'minimum_wage' => 12500.00],
        ];

        $out = [];
        foreach ($defs as $def) {
            $out[$def['code']] = Jurisdiction::query()->updateOrCreate(
                ['code' => $def['code']],
                array_merge($def, ['is_active' => true, 'meta' => ['demo' => true]])
            );
        }

        return $out;
    }

    /**
     * @param  array<string, Jurisdiction>  $jurisdictions
     * @return array<string, WageClassification>
     */
    protected function seedWageClasses(array $jurisdictions): array
    {
        $defs = [
            ['code' => 'NE-HOURLY', 'name' => 'Non-exempt Hourly', 'exempt_status' => 'non_exempt', 'base_rate' => 28.50, 'jur' => 'US-CA'],
            ['code' => 'EX-SALARY', 'name' => 'Exempt Salaried', 'exempt_status' => 'exempt', 'base_rate' => 45.00, 'jur' => 'US-NY'],
            ['code' => 'SNE-TECH', 'name' => 'Salaried Non-exempt Tech', 'exempt_status' => 'salaried_non_exempt', 'base_rate' => 32.00, 'jur' => 'US-TX'],
            ['code' => 'BD-FACTORY', 'name' => 'Factory Non-exempt', 'exempt_status' => 'non_exempt', 'base_rate' => 180.00, 'jur' => 'BD-DH'],
        ];

        $out = [];
        foreach ($defs as $def) {
            $out[$def['code']] = WageClassification::query()->updateOrCreate(
                ['code' => $def['code']],
                [
                    'name' => $def['name'],
                    'exempt_status' => $def['exempt_status'],
                    'base_rate' => $def['base_rate'],
                    'pay_frequency' => 'biweekly',
                    'jurisdiction_id' => $jurisdictions[$def['jur']]->id,
                    'description' => 'Demo wage classification for compliance evaluation.',
                    'is_active' => true,
                ]
            );
        }

        return $out;
    }

    /** @param  array<string, Jurisdiction>  $jurisdictions */
    protected function seedOvertimeRules(array $jurisdictions): void
    {
        $defs = [
            ['slug' => 'ca-daily-ot', 'name' => 'California Daily OT', 'jur' => 'US-CA', 'daily' => 8, 'weekly' => 40, 'ot' => 1.5, 'dt' => 2.0, 'priority' => 10],
            ['slug' => 'ny-weekly-ot', 'name' => 'New York Weekly OT', 'jur' => 'US-NY', 'daily' => 8, 'weekly' => 40, 'ot' => 1.5, 'dt' => null, 'priority' => 20],
            ['slug' => 'tx-flsa', 'name' => 'Texas FLSA Weekly', 'jur' => 'US-TX', 'daily' => 8, 'weekly' => 40, 'ot' => 1.5, 'dt' => null, 'priority' => 30],
            ['slug' => 'bd-factory-ot', 'name' => 'Dhaka Factory OT', 'jur' => 'BD-DH', 'daily' => 8, 'weekly' => 48, 'ot' => 2.0, 'dt' => null, 'priority' => 15],
        ];

        foreach ($defs as $def) {
            OvertimeRule::query()->updateOrCreate(
                ['slug' => $def['slug']],
                [
                    'name' => $def['name'],
                    'jurisdiction_id' => $jurisdictions[$def['jur']]->id,
                    'daily_threshold_hours' => $def['daily'],
                    'weekly_threshold_hours' => $def['weekly'],
                    'overtime_multiplier' => $def['ot'],
                    'double_time_multiplier' => $def['dt'],
                    'priority' => $def['priority'],
                    'is_active' => true,
                    'notes' => 'Seeded overtime rule for demo jurisdictions.',
                ]
            );
        }
    }

    /**
     * @param  array<string, Jurisdiction>  $jurisdictions
     * @param  array<string, WageClassification>  $classes
     * @param  array<string, User>  $users
     * @return array<int, PayrollEmployee>
     */
    protected function seedEmployees(array $jurisdictions, array $classes, array $users): array
    {
        $defs = [
            ['num' => 'EMP-1001', 'name' => 'Ayesha Rahman', 'email' => 'ayesha@horizon.test', 'jur' => 'US-CA', 'class' => 'NE-HOURLY', 'rate' => 32.00],
            ['num' => 'EMP-1002', 'name' => 'Brian Cole', 'email' => 'brian@horizon.test', 'jur' => 'US-NY', 'class' => 'EX-SALARY', 'rate' => 48.00],
            ['num' => 'EMP-1003', 'name' => 'Carlos Diaz', 'email' => 'carlos@horizon.test', 'jur' => 'US-TX', 'class' => 'SNE-TECH', 'rate' => 29.50],
            ['num' => 'EMP-1004', 'name' => 'Nadia Islam', 'email' => 'nadia@horizon.test', 'jur' => 'BD-DH', 'class' => 'BD-FACTORY', 'rate' => 210.00],
            ['num' => 'EMP-1005', 'name' => 'Elena Park', 'email' => 'elena@horizon.test', 'jur' => 'US-CA', 'class' => 'NE-HOURLY', 'rate' => 27.75],
        ];

        $employees = [];
        foreach ($defs as $def) {
            $employees[] = PayrollEmployee::query()->updateOrCreate(
                ['employee_number' => $def['num']],
                [
                    'full_name' => $def['name'],
                    'email' => $def['email'],
                    'jurisdiction_id' => $jurisdictions[$def['jur']]->id,
                    'wage_classification_id' => $classes[$def['class']]->id,
                    'manager_id' => $users['manager']->id,
                    'hourly_rate' => $def['rate'],
                    'status' => 'active',
                    'hired_on' => now()->subMonths(random_int(3, 36))->toDateString(),
                    'notes' => 'Demo payroll employee.',
                ]
            );
        }

        return $employees;
    }

    /**
     * @param  array<string, Jurisdiction>  $jurisdictions
     * @param  array<int, PayrollEmployee>  $employees
     * @return array<int, PayPeriod>
     */
    protected function seedPayPeriods(array $jurisdictions, array $employees): array
    {
        $calculator = app(OvertimeCalculator::class);
        $periods = [];

        foreach ([['PP-2026-21', 'US-CA', 44], ['PP-2026-22', 'US-NY', 38], ['PP-2026-23', 'BD-DH', 52]] as [$ref, $jur, $hours]) {
            $period = PayPeriod::query()->updateOrCreate(
                ['reference' => $ref],
                [
                    'jurisdiction_id' => $jurisdictions[$jur]->id,
                    'starts_on' => now()->subDays(14)->toDateString(),
                    'ends_on' => now()->subDay()->toDateString(),
                    'pay_date' => now()->addDays(3)->toDateString(),
                    'status' => 'processing',
                    'employee_count' => 0,
                    'gross_total' => 0,
                    'ot_total' => 0,
                    'notes' => 'Demo pay period.',
                ]
            );

            $gross = 0;
            $ot = 0;
            $count = 0;

            foreach ($employees as $employee) {
                if ($employee->jurisdiction_id !== $period->jurisdiction_id) {
                    continue;
                }

                $worked = $hours + random_int(-4, 6);
                $calc = $calculator->evaluate($employee, (float) $worked);
                $grossPay = ($calc['regular_hours'] * (float) $employee->hourly_rate) + $calc['ot_pay'];

                PayrollRun::query()->updateOrCreate(
                    [
                        'pay_period_id' => $period->id,
                        'payroll_employee_id' => $employee->id,
                    ],
                    [
                        'regular_hours' => $calc['regular_hours'],
                        'ot_hours' => $calc['ot_hours'],
                        'gross_pay' => $grossPay,
                        'ot_pay' => $calc['ot_pay'],
                        'status' => 'calculated',
                        'calc_meta' => $calc,
                    ]
                );

                $gross += $grossPay;
                $ot += $calc['ot_pay'];
                $count++;
            }

            $period->update([
                'employee_count' => $count,
                'gross_total' => round($gross, 2),
                'ot_total' => round($ot, 2),
            ]);

            $periods[] = $period;
        }

        return $periods;
    }

    /**
     * @param  array<string, Jurisdiction>  $jurisdictions
     * @param  array<int, PayPeriod>  $periods
     * @param  array<string, User>  $users
     */
    protected function seedFilings(array $jurisdictions, array $periods, array $users): void
    {
        $defs = [
            ['ref' => 'FIL-CA-941', 'title' => 'CA quarterly wage filing', 'jur' => 'US-CA', 'type' => 'tax', 'status' => 'in_progress', 'due' => now()->subDays(2)],
            ['ref' => 'FIL-NY-NYS45', 'title' => 'NY withholding remittance', 'jur' => 'US-NY', 'type' => 'tax', 'status' => 'draft', 'due' => now()->addDays(5)],
            ['ref' => 'FIL-BD-DIFE', 'title' => 'DIFE overtime attestation', 'jur' => 'BD-DH', 'type' => 'labor', 'status' => 'submitted', 'due' => now()->addDays(10)],
        ];

        foreach ($defs as $i => $def) {
            ComplianceFiling::query()->updateOrCreate(
                ['reference' => $def['ref']],
                [
                    'title' => $def['title'],
                    'jurisdiction_id' => $jurisdictions[$def['jur']]->id,
                    'pay_period_id' => $periods[$i % count($periods)]->id ?? null,
                    'owner_id' => $users['staff']->id,
                    'filing_type' => $def['type'],
                    'status' => $def['status'],
                    'due_on' => $def['due']->toDateString(),
                    'submitted_at' => $def['status'] === 'submitted' ? now()->subDay() : null,
                    'confirmation_code' => $def['status'] === 'submitted' ? 'CONF-'.Str::upper(Str::random(6)) : null,
                    'notes' => 'Demo compliance filing.',
                ]
            );
        }
    }

    /**
     * @param  array<string, Jurisdiction>  $jurisdictions
     * @param  array<int, PayrollEmployee>  $employees
     */
    protected function seedAlerts(array $jurisdictions, array $employees): void
    {
        ComplianceAlert::query()->updateOrCreate(
            ['title' => 'OT breach: EMP-1001 weekly hours', 'alert_type' => 'ot_breach'],
            [
                'jurisdiction_id' => $jurisdictions['US-CA']->id,
                'payroll_employee_id' => $employees[0]->id,
                'severity' => 'high',
                'message' => 'Employee exceeded weekly OT threshold under California daily OT rule.',
                'status' => 'open',
                'detected_at' => now()->subHours(6),
            ]
        );

        ComplianceAlert::query()->updateOrCreate(
            ['title' => 'Late filing: FIL-CA-941', 'alert_type' => 'late_filing'],
            [
                'jurisdiction_id' => $jurisdictions['US-CA']->id,
                'severity' => 'critical',
                'message' => 'CA quarterly wage filing is past due.',
                'status' => 'open',
                'source_type' => ComplianceFiling::class,
                'detected_at' => now()->subDay(),
            ]
        );

        ComplianceAlert::query()->updateOrCreate(
            ['title' => 'Review exempt status EMP-1002', 'alert_type' => 'misclassification'],
            [
                'jurisdiction_id' => $jurisdictions['US-NY']->id,
                'payroll_employee_id' => $employees[1]->id,
                'severity' => 'medium',
                'message' => 'Duties checklist suggested possible non-exempt treatment.',
                'status' => 'acknowledged',
                'detected_at' => now()->subDays(3),
            ]
        );
    }

    /**
     * @param  array<string, Jurisdiction>  $jurisdictions
     * @param  array<int, PayPeriod>  $periods
     * @param  array<string, User>  $users
     */
    protected function seedPdfPacks(array $jurisdictions, array $periods, array $users): void
    {
        PdfCompliancePack::query()->updateOrCreate(
            ['slug' => 'ca-ot-audit-pack'],
            [
                'title' => 'California OT Audit Pack',
                'jurisdiction_id' => $jurisdictions['US-CA']->id,
                'pay_period_id' => $periods[0]->id ?? null,
                'generated_by' => $users['admin']->id,
                'status' => 'ready',
                'locale' => 'en',
                'file_path' => 'storage/compliance/ca-ot-audit-pack.pdf',
                'generated_at' => now()->subHours(2),
                'summary' => 'Unicode-ready PDF pack for auditor OT review (demo path).',
            ]
        );
    }
}
