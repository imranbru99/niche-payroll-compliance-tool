@extends('layouts.marketing')

@section('title', 'Compliance Filings')
@section('meta_description', 'Track payroll tax and labor filings with due dates, statuses, confirmation codes, and late-filing alerts in PayComply.')

@section('content')
<section class="hero">
    <div class="eyebrow">Filings desk</div>
    <h1>Never miss a payroll filing deadline again.</h1>
    <p>Tax, labor, wage-board, and benefits filings tied to jurisdictions and pay periods — with late alerts when due dates slip.</p>
</section>
<section class="section">
    <div class="grid">
        <div class="card"><h3>Filing types</h3><p>Tax, labor, wage board, benefits.</p></div>
        <div class="card"><h3>Lifecycle</h3><p>Draft → in progress → submitted → accepted.</p></div>
        <div class="card"><h3>Evidence</h3><p>Confirmation codes and PDF compliance packs.</p></div>
        <div class="card"><h3>Risk sync</h3><p>FilingReminderService opens late_filing alerts.</p></div>
    </div>
</section>
@endsection
