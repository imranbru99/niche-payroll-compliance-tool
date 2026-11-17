@extends('layouts.marketing')

@section('title', 'Modules')
@section('meta_description', 'Toggleable PayComply modules for jurisdictions, overtime, wage classes, filings, alerts, PDF packs, AI assist, and attendance.')

@section('content')
<section class="hero">
    <div class="eyebrow">Module switchboard</div>
    <h1>Run only the compliance surface your business needs.</h1>
    <p>Core modules stay protected; optional AI, scraper, and attendance bridges stay off until you enable them.</p>
</section>
<section class="section">
    <table>
        <thead>
            <tr><th>Module</th><th>Category</th><th>Status</th><th>Hrs/wk</th><th>Core</th></tr>
        </thead>
        <tbody>
        @foreach($modules as $module)
            <tr>
                <td><strong>{{ $module['name'] }}</strong><br><span style="color:var(--muted);font-size:.85rem;">{{ $module['description'] }}</span></td>
                <td>{{ $module['category'] }}</td>
                <td><span class="pill {{ $module['enabled'] ? '' : 'off' }}">{{ $module['enabled'] ? 'Enabled' : 'Disabled' }}</span></td>
                <td>{{ $module['hours_saved_weekly'] }}</td>
                <td>{{ !empty($module['core']) ? 'Yes' : 'No' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
@endsection
