@extends('layouts.marketing')

@section('title', 'Demo — PayComply')
@section('meta_description', 'Demo credentials for the Niche Payroll Compliance Tool admin panel.')

@section('content')
<h1 class="section-title">Demo credentials</h1>
<p style="color:var(--muted);">After <code>php artisan migrate --seed</code>, sign in at <a href="/admin">/admin</a>.</p>
<table>
    <thead><tr><th>User</th><th>Email</th><th>Password</th></tr></thead>
    <tbody>
        <tr><td>Demo</td><td>{{ $demoEmail ?? 'demo@paycomply.test' }}</td><td>password</td></tr>
        <tr><td>Super Admin</td><td>superadmin@paycomply.test</td><td>password</td></tr>
        <tr><td>Admin</td><td>admin@paycomply.test</td><td>password</td></tr>
        <tr><td>Manager</td><td>manager@paycomply.test</td><td>password</td></tr>
        <tr><td>Staff</td><td>staff@paycomply.test</td><td>password</td></tr>
        <tr><td>Client</td><td>client@paycomply.test</td><td>password</td></tr>
    </tbody>
</table>
<div class="cta"><a class="btn" href="/admin">Launch admin panel</a></div>
@endsection
