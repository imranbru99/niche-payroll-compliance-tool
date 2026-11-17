@extends('layouts.marketing')

@section('title', 'Live Demo')
@section('meta_description', 'PayComply demo credentials for Filament admin — explore overtime, wage classes, filings, and module toggles.')

@section('content')
<section class="hero">
    <div class="eyebrow">Try PayComply</div>
    <h1>Demo users ready after migrate --seed.</h1>
    <p>Sign in at <code>/admin</code> with any seeded role. Prefer the Demo user for safe evaluation.</p>
</section>
<section class="section">
    <div class="card" style="max-width:520px;">
        <h3>Primary demo login</h3>
        <p><strong>Email:</strong> <code>{{ $demoEmail }}</code></p>
        <p><strong>Password:</strong> <code>{{ $demoPassword }}</code></p>
        <div class="cta-row" style="margin-top:1rem;">
            <a class="btn" href="/admin/login">Open Filament admin</a>
        </div>
    </div>
    <div class="card" style="margin-top:1rem;">
        <h3>All seeded roles</h3>
        <p>Super Admin <code>admin@payroll-compliance.test</code> · Admin · Manager · Staff · Client · Demo — password <code>password</code>.</p>
    </div>
</section>
@endsection
