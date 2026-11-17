@extends('layouts.marketing')

@section('title', 'Niche Payroll Compliance Tool')
@section('meta_description', 'Niche payroll compliance tool for overtime rules, wage classifications, filings, and jurisdiction-aware payroll controls that reduce compliance risk.')

@section('content')
<section class="hero">
    <div class="eyebrow">PayComply · Jurisdiction-aware payroll</div>
    <h1>Payroll compliance without the spreadsheet risk.</h1>
    <p>Control overtime rules, wage classifications, filings, and alerts across jurisdictions — then toggle modules so each employer only runs what auditors require.</p>
    <div class="cta-row">
        <a class="btn" href="{{ route('demo') }}">Open demo credentials</a>
        <a class="btn secondary" href="{{ route('modules') }}">Explore modules</a>
    </div>
</section>

<section class="section">
    <div class="grid">
        <div class="card"><div class="kpi">{{ $hoursSaved }}+</div><p>Estimated weekly hours unlocked by enabled modules</p></div>
        <div class="card"><div class="kpi">{{ $modules->where('enabled', true)->count() }}</div><p>Modules currently enabled in this deployment</p></div>
        <div class="card"><div class="kpi">12</div><p>Toggleable compliance & platform modules</p></div>
    </div>
</section>

<section class="section">
    <h2>Built for payroll & compliance leaders</h2>
    <p style="color:var(--muted);max-width:640px;">Answer OT exposure, classification gaps, and filing deadlines from one Filament admin with gold-accent operational clarity.</p>
    <div class="grid" style="margin-top:1.2rem;">
        <div class="card"><h3>Overtime engine</h3><p>Daily/weekly thresholds and multipliers by jurisdiction.</p></div>
        <div class="card"><h3>Wage classes</h3><p>Exempt vs non-exempt catalogs tied to minimum wage bands.</p></div>
        <div class="card"><h3>Filings & alerts</h3><p>Due-date filings with late-risk alerts for auditors.</p></div>
        <div class="card"><h3>Module switchboard</h3><p>Turn AI, attendance, or PDF packs on only when needed.</p></div>
    </div>
</section>
@endsection
