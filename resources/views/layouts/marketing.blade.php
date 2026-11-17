<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PayComply — Niche Payroll Compliance Tool')</title>
    <meta name="description" content="@yield('meta_description', 'Niche payroll compliance tool for overtime rules, wage classifications, filings, and jurisdiction-aware payroll controls that reduce compliance risk.')">
    <meta name="author" content="Imran Ahmed <me@imrandev.bd>">
    <meta name="theme-color" content="#CA8A04">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --accent: {{ $accent ?? '#CA8A04' }}; --ink:#422006; --muted:#78716c; --bg:#fffbeb; }
        * { box-sizing: border-box; }
        body { margin:0; font-family:'Manrope',sans-serif; color:var(--ink); background:
            radial-gradient(1000px 420px at 85% -5%, color-mix(in srgb, var(--accent) 32%, white), transparent),
            linear-gradient(165deg, #fffbeb 0%, #f8fafc 48%, #ffffff 100%); }
        a { color: var(--accent); text-decoration: none; }
        .wrap { width: min(1120px, 92%); margin: 0 auto; }
        header { display:flex; justify-content:space-between; align-items:center; padding:1.25rem 0; }
        .brand { font-family:'Fraunces',serif; font-size:1.7rem; font-weight:700; color:var(--accent); }
        nav { display:flex; gap:1rem; flex-wrap:wrap; align-items:center; }
        nav a { color:var(--muted); font-weight:600; }
        .btn { display:inline-block; background:var(--accent); color:#fff !important; padding:.75rem 1.15rem; border-radius:.35rem; font-weight:700; }
        .btn.ghost { background:transparent; color:var(--accent) !important; border:1px solid color-mix(in srgb, var(--accent) 55%, white); }
        .hero { padding: 3.5rem 0 2.5rem; display:grid; gap:1rem; max-width: 48rem; }
        .hero h1 { font-family:'Fraunces',serif; font-size: clamp(2.3rem, 5vw, 3.5rem); line-height:1.08; margin:0; color:var(--accent); }
        .hero p { font-size:1.125rem; color:var(--muted); margin:0; }
        .cta { display:flex; gap:.75rem; flex-wrap:wrap; margin-top:.75rem; }
        .grid { display:grid; grid-template-columns: repeat(auto-fit,minmax(240px,1fr)); gap:1rem; padding: 1.5rem 0 3rem; }
        .card { background: rgba(255,255,255,.9); border:1px solid #fde68a; border-radius:.65rem; padding:1.25rem; }
        .card h3 { margin:.2rem 0 .5rem; font-size:1.1rem; }
        .card p { margin:0; color:var(--muted); }
        .badge { display:inline-block; font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:.04em; color:var(--accent); }
        footer { border-top:1px solid #fde68a; padding:2rem 0; color:var(--muted); font-size:.95rem; }
        .section-title { font-family:'Fraunces',serif; font-size:2rem; color:var(--accent); margin:2rem 0 .5rem; }
        table { width:100%; border-collapse:collapse; margin:1rem 0 2rem; }
        th, td { text-align:left; padding:.65rem .5rem; border-bottom:1px solid #fde68a; }
        @media (max-width:720px){ header{flex-direction:column; align-items:flex-start; gap:1rem;} }
    </style>
</head>
<body>
<div class="wrap">
    <header>
        <a class="brand" href="{{ route('home') }}">PayComply</a>
        <nav>
            <a href="{{ route('features') }}">Features</a>
            <a href="{{ route('modules') }}">Modules</a>
            <a href="{{ route('pricing') }}">Pricing</a>
            <a href="{{ route('security') }}">Security</a>
            <a href="{{ route('demo') }}">Demo</a>
            <a class="btn" href="/admin">Admin Login</a>
        </nav>
    </header>
    @yield('content')
    <footer>
        <p><strong>Niche Payroll Compliance Tool</strong> — built by <a href="https://imrandev.bd">Imran Ahmed</a> · <a href="mailto:me@imrandev.bd">me@imrandev.bd</a></p>
        <p>Toggleable modules for overtime rules, wage classes, filings, jurisdictions, audits, and AI compliance alerts.</p>
    </footer>
</div>
</body>
</html>
