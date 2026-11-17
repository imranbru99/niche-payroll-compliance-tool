@extends('layouts.marketing')

@section('title', 'Features')
@section('meta_description', 'PayComply features: overtime rules, wage classifications, jurisdiction catalogs, compliance filings, risk alerts, PDF packs, and modular payroll controls.')

@section('content')
<section class="hero">
    <div class="eyebrow">Product features</div>
    <h1>Everything a niche payroll compliance stack needs.</h1>
    <p>From jurisdiction catalogs to OT calculators and filing reminders — each capability can be enabled or quieted via modules.</p>
</section>
<section class="section">
    <div class="grid">
        @foreach($modules as $module)
            <div class="card">
                <span class="pill {{ $module['enabled'] ? '' : 'off' }}">{{ $module['enabled'] ? 'ON' : 'OFF' }}</span>
                <h3 style="margin-top:.55rem;">{{ $module['name'] }}</h3>
                <p>{{ $module['description'] }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
