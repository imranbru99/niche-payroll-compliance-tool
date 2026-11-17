<?php

namespace App\Http\Controllers;

use App\Models\ComplianceAlert;
use App\Models\ComplianceFiling;
use App\Models\PayrollEmployee;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortalController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $employees = PayrollEmployee::query()
            ->when($user->email, fn ($q) => $q->where('email', $user->email))
            ->orWhere('manager_id', $user->id)
            ->limit(20)
            ->get();

        $filings = ComplianceFiling::query()
            ->where('owner_id', $user->id)
            ->latest('due_on')
            ->limit(10)
            ->get();

        $alerts = ComplianceAlert::query()
            ->where('status', 'open')
            ->latest('detected_at')
            ->limit(10)
            ->get();

        return view('portal.index', [
            'user' => $user,
            'employees' => $employees,
            'filings' => $filings,
            'alerts' => $alerts,
            'accent' => '#CA8A04',
        ]);
    }
}
