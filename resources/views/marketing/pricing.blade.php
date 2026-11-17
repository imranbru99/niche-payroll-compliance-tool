@extends('layouts.marketing')

@section('title', 'Pricing')
@section('meta_description', 'PayComply pricing orientation for teams deploying modular payroll compliance with Filament admin and demo access.')

@section('content')
<section class="hero">
    <div class="eyebrow">Commercial packaging</div>
    <h1>Start modular. Scale when mandates expand.</h1>
    <p>Self-host with Docker. Enable only the modules your auditors require. Extend with Packagist packages for AI, PDF, and attendance.</p>
</section>
<section class="section">
    <div class="grid">
        <div class="card">
            <h3>Starter</h3>
            <p class="kpi">Core</p>
            <p>Jurisdictions, wage classes, OT rules, employees, pay periods, filings.</p>
        </div>
        <div class="card">
            <h3>Compliance+</h3>
            <p class="kpi">Risk</p>
            <p>Adds alerts, PDF packs, and speed optimizer for audit cycles.</p>
        </div>
        <div class="card">
            <h3>Platform</h3>
            <p class="kpi">Full</p>
            <p>AI assist, labor catalog scrape, attendance bridge for OT feeds.</p>
        </div>
    </div>
</section>
@endsection
