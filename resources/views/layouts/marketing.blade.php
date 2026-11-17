<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Niche Payroll Compliance Tool') — PayComply</title>
    <meta name="description" content="@yield('meta_description', 'Niche payroll compliance tool for overtime rules, wage classifications, filings, and jurisdiction-aware payroll controls that reduce compliance risk.')">
    <meta name="keywords" content="payroll compliance, overtime rules, wage classification, jurisdiction payroll, labor filings, FLSA controls, Laravel Filament payroll">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&family=Sora:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #CA8A04;
            --accent-dark: #A16207;
            --ink: #422006;
            --muted: #78716c;
            --mist: #fef9c3;
            --line: #fde68a;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Figtree", system-ui, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(1000px 480px at 0% -10%, #fde047 0%, transparent 55%),
                radial-gradient(900px 420px at 100% 0%, #facc15 0%, transparent 40%),
                linear-gradient(180deg, #fffbeb 0%, #ffffff 40%, #fefce8 100%);
            min-height: 100vh;
        }
        a { color: var(--accent-dark); text-decoration: none; }
        .wrap { width: min(1120px, 92%); margin: 0 auto; }
        header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 0; gap: 1rem; flex-wrap: wrap;
        }
        .brand {
            font-family: "Sora", sans-serif;
            font-size: 1.4rem; color: var(--accent-dark); letter-spacing: -0.02em;
        }
        nav { display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; }
        nav a { color: var(--muted); font-weight: 500; font-size: .92rem; }
        nav a:hover { color: var(--accent-dark); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            background: var(--accent); color: #fff !important; border-radius: 12px;
            padding: .7rem 1.15rem; font-weight: 700; border: 0; cursor: pointer;
            box-shadow: 0 12px 28px rgba(202, 138, 4, .28);
        }
        .btn.secondary { background: transparent; color: var(--accent-dark) !important; border: 1.5px solid var(--accent); box-shadow: none; }
        .hero { padding: 3.2rem 0 2.2rem; display: grid; gap: 1.1rem; max-width: 780px; }
        .hero h1 {
            font-family: "Sora", sans-serif;
            font-size: clamp(2.3rem, 5vw, 3.5rem); line-height: 1.08; margin: 0;
            color: var(--ink);
        }
        .hero p { font-size: 1.12rem; color: var(--muted); margin: 0; line-height: 1.65; }
        .cta-row { display: flex; gap: .8rem; flex-wrap: wrap; margin-top: .4rem; }
        .grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        .card {
            background: rgba(255,255,255,.88); border: 1px solid var(--line);
            border-radius: 18px; padding: 1.15rem 1.2rem;
            backdrop-filter: blur(6px);
        }
        .card h3 { margin: 0 0 .4rem; font-size: 1.05rem; }
        .card p { margin: 0; color: var(--muted); line-height: 1.5; font-size: .94rem; }
        .section { padding: 2.4rem 0; }
        .section h2 {
            font-family: "Sora", sans-serif;
            font-size: clamp(1.75rem, 3vw, 2.35rem); margin: 0 0 .45rem;
        }
        .eyebrow { color: var(--accent-dark); font-weight: 700; text-transform: uppercase; letter-spacing: .08em; font-size: .72rem; }
        .pill {
            display: inline-block; padding: .2rem .55rem; border-radius: 999px;
            background: #fef08a; color: var(--accent-dark); font-size: .72rem; font-weight: 700;
        }
        .pill.off { background: #fee2e2; color: #991b1b; }
        footer { border-top: 1px solid var(--line); margin-top: 3rem; padding: 2rem 0 3rem; color: var(--muted); font-size: .92rem; }
        .kpi { font-size: 1.75rem; font-weight: 700; color: var(--accent-dark); }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: .65rem .4rem; border-bottom: 1px solid var(--line); font-size: .92rem; }
        code { background: #fef9c3; padding: .1rem .35rem; border-radius: 6px; }
    </style>
</head>
<body>
<div class="wrap">
    <header>
        <a class="brand" href="{{ route('home') }}">PayComply</a>
        <nav>
            <a href="{{ route('features') }}">Features</a>
            <a href="{{ route('modules') }}">Modules</a>
            <a href="{{ route('overtime') }}">Overtime</a>
            <a href="{{ route('filings') }}">Filings</a>
            <a href="{{ route('pricing') }}">Pricing</a>
            <a href="{{ route('demo') }}">Demo</a>
            <a class="btn" href="/admin">Admin</a>
        </nav>
    </header>
    @yield('content')
    <footer>
        <p><strong>PayComply</strong> — niche payroll compliance for overtime, wage classes, filings, and jurisdiction controls.</p>
        <p>Built by <a href="https://imrandev.bd">Imran Ahmed</a> · <a href="mailto:me@imrandev.bd">me@imrandev.bd</a></p>
    </footer>
</div>
</body>
</html>
