@extends('layouts.marketing')

@section('title', 'Modules — PayComply')
@section('meta_description', 'Toggle payroll compliance modules on or off: jurisdictions, wage classes, OT rules, filings, alerts, PDF packs, and AI assist.')

@section('content')
<h1 class="section-title">Toggleable modules</h1>
<p style="color:var(--muted);">Enable only the compliance domains your payroll operation needs. Disabled modules hide from Filament navigation and refuse resource access.</p>
<table>
    <thead>
        <tr><th>Module</th><th>Category</th><th>Status</th><th>Hours saved / week</th></tr>
    </thead>
    <tbody>
        @foreach($modules as $module)
            <tr>
                <td><strong>{{ $module['name'] ?? $module['key'] }}</strong><br><span style="color:var(--muted);font-size:.9rem;">{{ $module['description'] ?? '' }}</span></td>
                <td>{{ $module['category'] ?? '—' }}</td>
                <td>{{ ($module['enabled'] ?? false) ? 'ON' : 'OFF' }}</td>
                <td>{{ $module['hours_saved_weekly'] ?? 0 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
