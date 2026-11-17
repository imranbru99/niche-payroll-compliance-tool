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
use App\Services\FilingReminderService;
use App\Services\ModuleManager;
use App\Services\OvertimeCalculator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        app(ModuleManager::class)->syncFromConfig();

        $users = [
            ['email' => 'superadmin@paycomply.test', 'name' => 'Super Admin', 'role' => UserRole::SuperAdmin, 'job_title' => 'Compliance Director'],
            ['email' => 'admin@paycomply.test', 'name' => 'Payroll Admin', 'role' => UserRole::Admin, 'job_title' => 'Payroll Administrator'],
            ['email' => 'manager@paycomply.test', 'name' => 'Payroll Manager', 'role' => UserRole::Manager, 'job_title' => 'HR Payroll Manager'],
            ['email' => 'staff@paycomply.test', 'name' => 'Payroll Staff', 'role' => UserRole::Staff, 'job_title' => 'Payroll Specialist'],
            ['email' => 'demo@paycomply.test', 'name' => 'Demo User', 'role' => UserRole::Demo, 'job_title' => 'Demo Evaluator'],
            ['email' => 'client@paycomply.test', 'name' => 'Client Contact', 'role' => UserRole::Client, 'job_title' => 'Client Portal'],
        ];

        $created = [];
        foreach ($users as $row) {
            $created[$row['email']] = User::query()->updateOrCreate(
                ['email' => $row['email']],
                [
                    'name' => $row['name'],
                    'password' => Hash::make('password'),
                    'role' => $row['role'],
                    'job_title' => $row['job_title'],
                    'organization_name' => 'PayComply Demo Co',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }

        $manager = $created['manager@paycomply.test'];
        $admin = $created['admin@paycomply.test'];

        $ca = Jurisdiction::query()->updateOrCreate(
            ['code' => 'US-CA'],
            [
                'name' => 'California',
                'country_code' => 'US',
                'region' => 'West',
                'authority_name' => 'DIR / EDD',
                'currency_code' => 'USD',
                'minimum_wage' => 16.00,
                'is_active' => true,
                'meta' => ['ot_daily' => true],
            ]
        );

        $ny = Jurisdiction::query()->updateOrCreate(
            ['code' => 'US-NY'],
            [
                'name' => 'New York',
                'country_code' => 'US',
                'region' => 'Northeast',
                'authority_name' => 'NY DOL',
                'currency_code' => 'USD',
                'minimum_wage' => 16.50,
                'is_active' => true,
            ]
        );

        $tx = Jurisdiction::query()->updateOrCreate(
            ['code' => 'US-TX'],
            [
                'name' => 'Texas',
                'country_code' => 'US',
                'region' => 'South',
                'authority_name' => 'TWC',
                'currency_code' => 'USD',
                'minimum_wage' => 7.25,
                'is_active' => true,
            ]
        );

        $nonExempt = WageClassification::query()->updateOrCreate(
            ['code' => 'NE-HOURLY'],
            [
                'jurisdiction_id' => $ca->id,
                'name' => 'Non-exempt hourly',
                'exempt_status' => 'non_exempt',
                'base_rate' => 28.50,
                'pay_frequency' => 'biweekly',
                'description' => 'Standard non-exempt wage class for hourly staff.',
                'is_active' => true,
            ]
        );

        WageClassification::query()->updateOrCreate(
            ['code' => 'EX-SALARY'],
            [
                'jurisdiction_id' => $ny->id,
                'name' => 'Exempt salaried',
                'exempt_status' => 'exempt',
                'base_rate' => 95.00,
                'pay_frequency' => 'semimonthly',
                'description' => 'Exempt professional classification.',
                'is_active' => true,
            ]
        );

        OvertimeRule::query()->updateOrCreate(
            ['slug' => 'california-daily-weekly'],
            [
                'jurisdiction_id' => $ca->id,
                'name' => 'California daily + weekly OT',
                'daily_threshold_hours' => 8,
                'weekly_threshold_hours' => 40,
                'overtime_multiplier' => 1.5,
                'double_time_multiplier' => 2.0,
                'priority' => 200,
                'is_active' => true,
                'notes' => 'CA daily OT after 8 hours.',
            ]
        );

        OvertimeRule::query()->updateOrCreate(
            ['slug' => 'flsa-weekly-default'],
            [
                'jurisdiction_id' => $tx->id,
                'name' => 'FLSA weekly default',
                'daily_threshold_hours' => 24,
                'weekly_threshold_hours' => 40,
                'overtime_multiplier' => 1.5,
                'double_time_multiplier' => null,
                'priority' => 100,
                'is_active' => true,
                'notes' => 'Federal weekly OT baseline.',
            ]
        );

        $employee = PayrollEmployee::query()->updateOrCreate(
            ['employee_number' => 'EMP-1001'],
            [
                'full_name' => 'Jordan Lee',
                'email' => 'jordan.lee@paycomply.test',
                'jurisdiction_id' => $ca->id,
                'wage_classification_id' => $nonExempt->id,
                'manager_id' => $manager->id,
                'hourly_rate' => 32.00,
                'status' => 'active',
                'hired_on' => now()->subYears(2)->toDateString(),
            ]
        );

        $employee2 = PayrollEmployee::query()->updateOrCreate(
            ['employee_number' => 'EMP-1002'],
            [
                'full_name' => 'Sam Rivera',
                'email' => 'sam.rivera@paycomply.test',
                'jurisdiction_id' => $ny->id,
                'wage_classification_id' => $nonExempt->id,
                'manager_id' => $manager->id,
                'hourly_rate' => 29.75,
                'status' => 'active',
                'hired_on' => now()->subYear()->toDateString(),
            ]
        );

        $period = PayPeriod::query()->updateOrCreate(
            ['reference' => 'PP-2026-11A'],
            [
                'jurisdiction_id' => $ca->id,
                'starts_on' => now()->startOfMonth()->toDateString(),
                'ends_on' => now()->startOfMonth()->addDays(13)->toDateString(),
                'pay_date' => now()->startOfMonth()->addDays(18)->toDateString(),
                'status' => 'open',
                'employee_count' => 2,
                'gross_total' => 0,
                'ot_total' => 0,
            ]
        );

        $calc = app(OvertimeCalculator::class);
        $hours = [46.0, 41.5];
        $gross = 0;
        $otTotal = 0;

        foreach ([[$employee, $hours[0]], [$employee2, $hours[1]]] as [$emp, $worked]) {
            $result = $calc->evaluate($emp, $worked);
            $grossPay = ($result['regular_hours'] * (float) $emp->hourly_rate) + $result['ot_pay'];
            $gross += $grossPay;
            $otTotal += $result['ot_pay'];

            PayrollRun::query()->updateOrCreate(
                [
                    'pay_period_id' => $period->id,
                    'payroll_employee_id' => $emp->id,
                ],
                [
                    'regular_hours' => $result['regular_hours'],
                    'ot_hours' => $result['ot_hours'],
                    'gross_pay' => round($grossPay, 2),
                    'ot_pay' => $result['ot_pay'],
                    'status' => 'calculated',
                    'calc_meta' => $result,
                ]
            );
        }

        $period->update([
            'gross_total' => round($gross, 2),
            'ot_total' => round($otTotal, 2),
        ]);

        ComplianceFiling::query()->updateOrCreate(
            ['reference' => 'FIL-CA-UI-2026Q4'],
            [
                'jurisdiction_id' => $ca->id,
                'pay_period_id' => $period->id,
                'owner_id' => $admin->id,
                'title' => 'California UI wage report',
                'filing_type' => 'tax',
                'status' => 'in_progress',
                'due_on' => now()->addDays(12)->toDateString(),
                'notes' => 'Quarterly unemployment insurance wage report.',
            ]
        );

        ComplianceFiling::query()->updateOrCreate(
            ['reference' => 'FIL-NY-WH-LATE'],
            [
                'jurisdiction_id' => $ny->id,
                'pay_period_id' => $period->id,
                'owner_id' => $manager->id,
                'title' => 'NY withholding remittance',
                'filing_type' => 'tax',
                'status' => 'draft',
                'due_on' => now()->subDays(3)->toDateString(),
                'notes' => 'Seeded late filing for alert demo.',
            ]
        );

        ComplianceAlert::query()->updateOrCreate(
            [
                'alert_type' => 'ot_breach',
                'title' => 'Weekly OT breach: Jordan Lee',
            ],
            [
                'jurisdiction_id' => $ca->id,
                'payroll_employee_id' => $employee->id,
                'severity' => 'high',
                'message' => 'Employee exceeded weekly OT threshold under California daily+weekly rule.',
                'status' => 'open',
                'source_type' => PayrollRun::class,
                'detected_at' => now()->subHours(6),
            ]
        );

        ComplianceAlert::query()->updateOrCreate(
            [
                'alert_type' => 'misclassification',
                'title' => 'Review exempt status for NY salaried role',
            ],
            [
                'jurisdiction_id' => $ny->id,
                'severity' => 'medium',
                'message' => 'AI assist flagged potential duties mismatch for exempt classification.',
                'status' => 'open',
                'detected_at' => now()->subDay(),
            ]
        );

        PdfCompliancePack::query()->updateOrCreate(
            ['slug' => 'ca-nov-audit-pack'],
            [
                'title' => 'California November audit pack',
                'jurisdiction_id' => $ca->id,
                'pay_period_id' => $period->id,
                'generated_by' => $admin->id,
                'status' => 'ready',
                'locale' => 'en',
                'file_path' => 'compliance-packs/ca-nov-audit-pack.pdf',
                'generated_at' => now(),
                'summary' => 'Unicode-ready PDF pack covering OT exposure, wage classes, and filings.',
            ]
        );

        app(FilingReminderService::class)->syncLateAlerts();
    }
}

