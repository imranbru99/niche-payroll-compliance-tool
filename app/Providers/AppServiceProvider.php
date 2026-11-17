<?php

namespace App\Providers;

use App\Models\ComplianceFiling;
use App\Models\Jurisdiction;
use App\Policies\ComplianceFilingPolicy;
use App\Policies\JurisdictionPolicy;
use App\Services\ModuleManager;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ModuleManager::class);
    }

    public function boot(): void
    {
        Gate::policy(Jurisdiction::class, JurisdictionPolicy::class);
        Gate::policy(ComplianceFiling::class, ComplianceFilingPolicy::class);
    }
}
