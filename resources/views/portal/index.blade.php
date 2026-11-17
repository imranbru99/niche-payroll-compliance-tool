@extends('layouts.marketing')

@section('title', 'Client Portal — PayComply')

@section('content')
<h1 class="section-title">Client compliance portal</h1>
<p style="color:var(--muted);">Authenticated view of recent pay periods and filings.</p>
<div class="grid">
    <article class="card">
        <h3>Recent pay periods</h3>
        <ul>
            @forelse($periods as $period)
                <li>{{ $period->reference }} — {{ $period->status }} ({{ $period->starts_on?->toDateString() }} → {{ $period->ends_on?->toDateString() }})</li>
            @empty
                <li>No periods yet.</li>
            @endforelse
        </ul>
    </article>
    <article class="card">
        <h3>Recent filings</h3>
        <ul>
            @forelse($filings as $filing)
                <li>{{ $filing->reference }} — {{ $filing->title }} ({{ $filing->status }})</li>
            @empty
                <li>No filings yet.</li>
            @endforelse
        </ul>
    </article>
</div>
@endsection
