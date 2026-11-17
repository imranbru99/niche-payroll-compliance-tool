<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Toggleable payroll compliance modules
    |--------------------------------------------------------------------------
    | Payroll and HR teams enable only the compliance domains they need.
    */
    'jurisdictions' => [
        'enabled' => (bool) env('MODULE_JURISDICTIONS', true),
        'name' => 'Jurisdictions',
        'description' => 'Country/state/city catalogs with filing calendars and authority references.',
        'category' => 'compliance',
        'hours_saved_weekly' => 16,
        'core' => true,
    ],
    'wage_classes' => [
        'enabled' => (bool) env('MODULE_WAGE_CLASSES', true),
        'name' => 'Wage Classifications',
        'description' => 'Exempt/non-exempt, FLSA-style classes, minimum wage bands, and pay codes.',
        'category' => 'payroll',
        'hours_saved_weekly' => 22,
        'core' => true,
    ],
    'overtime_rules' => [
        'enabled' => (bool) env('MODULE_OVERTIME_RULES', true),
        'name' => 'Overtime Rules',
        'description' => 'Daily/weekly OT multipliers, double-time thresholds, and jurisdiction overrides.',
        'category' => 'payroll',
        'hours_saved_weekly' => 28,
        'core' => true,
    ],
    'employees' => [
        'enabled' => (bool) env('MODULE_EMPLOYEES', true),
        'name' => 'Employee Roster',
        'description' => 'Worker profiles linked to wage class, jurisdiction, and pay schedule.',
        'category' => 'workforce',
        'hours_saved_weekly' => 14,
        'core' => true,
    ],
    'pay_periods' => [
        'enabled' => (bool) env('MODULE_PAY_PERIODS', true),
        'name' => 'Pay Periods & Runs',
        'description' => 'Pay period calendars, payroll run status, and gross-to-net snapshots.',
        'category' => 'payroll',
        'hours_saved_weekly' => 24,
        'core' => true,
    ],
    'filings' => [
        'enabled' => (bool) env('MODULE_FILINGS', true),
        'name' => 'Compliance Filings',
        'description' => 'Tax and labor filings with due dates, submission status, and evidence links.',
        'category' => 'compliance',
        'hours_saved_weekly' => 20,
        'core' => true,
    ],
    'alerts' => [
        'enabled' => (bool) env('MODULE_ALERTS', true),
        'name' => 'Compliance Alerts',
        'description' => 'Risk alerts for OT breaches, misclassification, and late filings.',
        'category' => 'risk',
        'hours_saved_weekly' => 18,
        'core' => false,
    ],
    'pdf_packs' => [
        'enabled' => (bool) env('MODULE_PDF_PACKS', true),
        'name' => 'PDF Compliance Packs',
        'description' => 'Unicode-ready PDF packs for auditors, finance, and regulators.',
        'category' => 'reporting',
        'hours_saved_weekly' => 12,
        'core' => false,
    ],
    'ai_assist' => [
        'enabled' => (bool) env('MODULE_AI_ASSIST', true),
        'name' => 'AI Payroll Assist',
        'description' => 'AI hub wiring for classification hints, filing narratives, and rule summaries.',
        'category' => 'ai',
        'hours_saved_weekly' => 16,
        'core' => false,
    ],
    'catalog_scrape' => [
        'enabled' => (bool) env('MODULE_CATALOG_SCRAPE', false),
        'name' => 'Labor Catalog Scraper',
        'description' => 'Optional AI catalog scrape assist for wage boards and labor authority libraries.',
        'category' => 'data',
        'hours_saved_weekly' => 8,
        'core' => false,
    ],
    'attendance_ops' => [
        'enabled' => (bool) env('MODULE_ATTENDANCE_OPS', false),
        'name' => 'Attendance Bridge',
        'description' => 'Optional attendance hub bridge for time-clock feeds into OT calculations.',
        'category' => 'workforce',
        'hours_saved_weekly' => 10,
        'core' => false,
    ],
    'speed_optimizer' => [
        'enabled' => (bool) env('MODULE_SPEED_OPTIMIZER', true),
        'name' => 'Drutogoti Speed Layer',
        'description' => 'Performance helpers for payroll admin dashboards and filing forms.',
        'category' => 'platform',
        'hours_saved_weekly' => 6,
        'core' => false,
    ],
];
