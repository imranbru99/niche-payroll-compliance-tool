@extends('layouts.marketing')

@section('title', 'PayComply — Niche Payroll Compliance Tool')
@section('meta_description', 'Niche payroll compliance tool for overtime rules, wage classifications, filings, and jurisdiction-aware payroll controls that reduce compliance risk.')

@section('content')
<section class="hero">
    <div class="badge">Jurisdiction-aware payroll compliance</div>
    <h1>PayComply</h1>
    <p>Overtime rules, wage classifications, filings, and multi-jurisdiction controls that reduce compliance risk — without forcing every payroll team onto the same module set.</p>
    <div class="cta">
        <a class="btn" href="/admin">Open Admin</a>
        <a class="btn ghost" href="{{ route('demo') }}">Try demo users</a>
    </div>
    <p style="margin-top:1rem;color:var(--muted);font-size:.95rem;">Enabled modules reclaim ~{{ $hoursSaved ?? 0 }} hours / week of compliance busywork.</p>
</section>
<section class="grid">
    @foreach($modules as $module)
        <article class="card">
            <span class="badge">{{ ($module['enabled'] ?? false) ? 'On' : 'Off' }}</span>
            <h3>{{ $module['name'] ?? ($module['key'] ?? 'Module') }}</h3>
            <p>{{ $module['description'] ?? '' }}</p>
        </article>
    @endforeach
</section>
@endsection
