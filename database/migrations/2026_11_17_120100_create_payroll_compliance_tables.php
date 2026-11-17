<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->boolean('enabled')->default(true);
            $table->boolean('is_core')->default(false);
            $table->unsignedInteger('hours_saved_weekly')->default(0);
            $table->timestamps();
        });

        Schema::create('jurisdictions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('country_code', 2);
            $table->string('region')->nullable();
            $table->string('authority_name')->nullable();
            $table->string('currency_code', 3)->default('USD');
            $table->decimal('minimum_wage', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('wage_classifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurisdiction_id')->nullable()->constrained()->nullOnDelete();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('exempt_status')->default('non_exempt');
            $table->decimal('base_rate', 10, 2)->nullable();
            $table->string('pay_frequency')->default('biweekly');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('overtime_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurisdiction_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('daily_threshold_hours', 5, 2)->default(8);
            $table->decimal('weekly_threshold_hours', 5, 2)->default(40);
            $table->decimal('overtime_multiplier', 4, 2)->default(1.5);
            $table->decimal('double_time_multiplier', 4, 2)->nullable();
            $table->unsignedInteger('priority')->default(100);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('payroll_employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->unique();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->foreignId('jurisdiction_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('wage_classification_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('hourly_rate', 10, 2)->default(0);
            $table->string('status')->default('active');
            $table->date('hired_on')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('pay_periods', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('jurisdiction_id')->nullable()->constrained()->nullOnDelete();
            $table->date('starts_on');
            $table->date('ends_on');
            $table->date('pay_date')->nullable();
            $table->string('status')->default('open');
            $table->unsignedInteger('employee_count')->default(0);
            $table->decimal('gross_total', 14, 2)->default(0);
            $table->decimal('ot_total', 14, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('payroll_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pay_period_id')->constrained()->cascadeOnDelete();
            $table->foreignId('payroll_employee_id')->constrained()->cascadeOnDelete();
            $table->decimal('regular_hours', 8, 2)->default(0);
            $table->decimal('ot_hours', 8, 2)->default(0);
            $table->decimal('gross_pay', 12, 2)->default(0);
            $table->decimal('ot_pay', 12, 2)->default(0);
            $table->string('status')->default('calculated');
            $table->json('calc_meta')->nullable();
            $table->timestamps();
        });

        Schema::create('compliance_filings', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('jurisdiction_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('pay_period_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('filing_type')->default('tax');
            $table->string('status')->default('draft');
            $table->date('due_on')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('compliance_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurisdiction_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('payroll_employee_id')->nullable()->constrained()->nullOnDelete();
            $table->string('alert_type');
            $table->string('severity')->default('medium');
            $table->string('title');
            $table->text('message')->nullable();
            $table->string('status')->default('open');
            $table->string('source_type')->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->timestamp('detected_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('pdf_compliance_packs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('jurisdiction_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('pay_period_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('draft');
            $table->string('locale')->default('en');
            $table->string('file_path')->nullable();
            $table->timestamp('generated_at')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_compliance_packs');
        Schema::dropIfExists('compliance_alerts');
        Schema::dropIfExists('compliance_filings');
        Schema::dropIfExists('payroll_runs');
        Schema::dropIfExists('pay_periods');
        Schema::dropIfExists('payroll_employees');
        Schema::dropIfExists('overtime_rules');
        Schema::dropIfExists('wage_classifications');
        Schema::dropIfExists('jurisdictions');
        Schema::dropIfExists('module_settings');
    }
};
