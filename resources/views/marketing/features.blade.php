@extends('layouts.marketing')

@section('title', 'Features — PayComply')
@section('meta_description', 'Payroll compliance features: overtime engines, wage class catalogs, filing calendars, jurisdiction controls, PDF packs, and AI alerts.')

@section('content')
<h1 class="section-title">Features built for payroll risk teams</h1>
<p style="color:var(--muted);max-width:42rem;">PayComply connects wage policy, time exposure, and statutory filings so managers catch overtime breaches and misclassification before auditors do.</p>
<section class="grid">
    <article class="card"><span class="badge">OT engine</span><h3>Overtime rule matrix</h3><p>Daily and weekly thresholds with jurisdiction multipliers and double-time overrides.</p></article>
    <article class="card"><span class="badge">Wage class</span><h3>Classification control</h3><p>Exempt / non-exempt catalogs linked to minimum wage bands and pay frequencies.</p></article>
    <article class="card"><span class="badge">Filings</span><h3>Filing calendar</h3><p>Due dates, confirmation codes, and late-filing alerts with owner accountability.</p></article>
    <article class="card"><span class="badge">AI</span><h3>Compliance alerts</h3><p>AI-assisted narratives for OT risk, misclass hints, and audit pack summaries.</p></article>
</section>
<section class="grid">
    @foreach($modules as $module)
        <article class="card">
            <span class="badge">{{ $module['category'] ?? 'module' }}</span>
            <h3>{{ $module['name'] ?? '' }}</h3>
            <p>{{ $module['description'] ?? '' }}</p>
        </article>
    @endforeach
</section>
@endsection
