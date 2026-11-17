@extends('layouts.marketing')

@section('title', 'Security — PayComply')
@section('meta_description', 'Role-based payroll compliance controls for Super Admin, Admin, Manager, Staff, Client, and Demo users.')

@section('content')
<h1 class="section-title">Security & role gates</h1>
<p style="color:var(--muted);max-width:42rem;">PayComply separates payroll staff work from client portal visibility. Module toggles and Filament policies keep sensitive wage data behind authenticated roles.</p>
<table>
    <thead><tr><th>Role</th><th>Access</th></tr></thead>
    <tbody>
        <tr><td>Super Admin</td><td>Full control including module toggles and user administration</td></tr>
        <tr><td>Admin</td><td>Payroll office administration across jurisdictions</td></tr>
        <tr><td>Manager</td><td>Team oversight, filings ownership, alert triage</td></tr>
        <tr><td>Staff</td><td>Day-to-day payroll runs and classification updates</td></tr>
        <tr><td>Client / Customer</td><td>Authenticated portal for filing/period visibility</td></tr>
        <tr><td>Demo</td><td>Seeded evaluator account with admin showcase access</td></tr>
    </tbody>
</table>
@endsection
