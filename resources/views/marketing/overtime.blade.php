@extends('layouts.marketing')

@section('title', 'Overtime Rules')
@section('meta_description', 'Jurisdiction-aware overtime rules with weekly thresholds, multipliers, and PayComply OT breach alerts.')

@section('content')
<section class="hero">
    <div class="eyebrow">Overtime controls</div>
    <h1>Jurisdiction-aware OT that finance can defend.</h1>
    <p>Model daily and weekly thresholds, 1.5× / 2.0× multipliers, and priority overrides per state or country — then surface breaches as compliance alerts.</p>
</section>
<section class="section">
    <div class="grid">
        <div class="card"><h3>Weekly thresholds</h3><p>Default 40h with CA-style daily OT options.</p></div>
        <div class="card"><h3>Multipliers</h3><p>Configurable OT and double-time factors.</p></div>
        <div class="card"><h3>Employee linkage</h3><p>Roster rates feed OT pay estimates per period.</p></div>
        <div class="card"><h3>Module gate</h3><p>Disable overtime_rules when not in scope.</p></div>
    </div>
</section>
@endsection
