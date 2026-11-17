<?php

namespace App\Http\Controllers;

use App\Services\ModuleManager;
use Illuminate\View\View;

class MarketingController extends Controller
{
    private string $accent = '#CA8A04';

    public function home(ModuleManager $modules): View
    {
        return view('marketing.home', [
            'modules' => $modules->all(),
            'hoursSaved' => $modules->weeklyHoursSaved(),
            'accent' => $this->accent,
        ]);
    }

    public function features(ModuleManager $modules): View
    {
        return view('marketing.features', [
            'modules' => $modules->all(),
            'accent' => $this->accent,
        ]);
    }

    public function modules(ModuleManager $modules): View
    {
        return view('marketing.modules', [
            'modules' => $modules->all(),
            'accent' => $this->accent,
        ]);
    }

    public function overtime(): View
    {
        return view('marketing.overtime', [
            'accent' => $this->accent,
        ]);
    }

    public function filings(): View
    {
        return view('marketing.filings', [
            'accent' => $this->accent,
        ]);
    }

    public function pricing(): View
    {
        return view('marketing.pricing', [
            'accent' => $this->accent,
        ]);
    }

    public function security(): View
    {
        return view('marketing.security', [
            'accent' => $this->accent,
        ]);
    }

    public function demo(): View
    {
        return view('marketing.demo', [
            'accent' => $this->accent,
        ]);
    }
}
