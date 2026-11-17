<?php

namespace App\Http\Controllers;

use App\Models\ComplianceFiling;
use App\Models\PayPeriod;
use Illuminate\View\View;

class PortalController extends Controller
{
    public function index(): View
    {
        return view('portal.index', [
            'accent' => config('payroll.accent'),
            'periods' => PayPeriod::query()->latest('starts_on')->limit(6)->get(),
            'filings' => ComplianceFiling::query()->latest('due_on')->limit(6)->get(),
        ]);
    }
}
