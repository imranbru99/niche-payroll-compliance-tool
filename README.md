# Niche Payroll Compliance Tool

![PayComply Dashboard](docs/screenshots/dashboard.png)

**Niche payroll compliance tool for overtime rules, wage classifications, filings, and jurisdiction-aware payroll controls that reduce compliance risk.**

[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-4-FDAE4B?logo=laravel&logoColor=white)](https://filamentphp.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?logo=php&logoColor=white)](https://www.php.net)
[![Docker](https://img.shields.io/badge/Docker-ready-2496ED?logo=docker&logoColor=white)](./docker-compose.yml)
[![Author](https://img.shields.io/badge/Author-Imran%20Ahmed-CA8A04)](https://imrandev.bd)

> SEO keywords: niche payroll compliance tool, overtime rules engine, wage classification, jurisdiction payroll controls, labor filings, FLSA compliance, payroll risk alerts, Laravel Filament payroll SaaS, modular payroll modules on off.

---

## Why PayComply?

Generic HRIS tools track hours. **PayComply** is a complete payroll compliance operating system: jurisdiction catalogs, wage classes, overtime multipliers, pay-period runs, compliance filings, risk alerts, Unicode PDF packs, and a module switchboard so each employer only runs what auditors require.

Built for payroll and compliance leaders who need to answer:

- Which OT threshold and multiplier apply in this jurisdiction?
- Is this worker correctly classified as exempt or non-exempt?
- Which filings are overdue — and who owns them?
- Which modules should stay off until our next audit cycle?

Accent theme: **`#CA8A04`** (gold) — production Filament admin + public marketing site.

---

## Product Snapshot

| Capability | What you get |
|---|---|
| Modular runtime | Enable/disable 12 payroll & platform modules |
| Multi-role IAM | Super Admin, Admin, Manager, Staff, Client, Demo |
| Jurisdictions | CA, NY, TX, BD demo catalogs with min wage |
| Wage classes | Exempt / non-exempt / salaried non-exempt |
| Overtime engine | Daily/weekly thresholds + multipliers |
| Pay periods | Gross & OT totals with per-employee runs |
| Filings | Tax/labor filings with due dates & confirmations |
| Alerts | OT breach, late filing, misclassification |
| PDF packs | Unicode-ready compliance packs for auditors |
| Public pages | Home, Features, Modules, Overtime, Filings, Pricing, Demo |
| Filament admin | Full CRUD + gold dashboard stats |
| Packagist stack | All 7 `imrandevbd/*` packages declared |

---

## Live Demo Credentials

After `php artisan migrate --seed`:

| Role | Email | Password |
|---|---|---|
| **Demo** | `demo@payroll-compliance.test` | `password` |
| Super Admin | `admin@payroll-compliance.test` | `password` |
| Admin | `payroll-admin@payroll-compliance.test` | `password` |
| Manager | `manager@payroll-compliance.test` | `password` |
| Staff | `staff@payroll-compliance.test` | `password` |
| Client | `client@payroll-compliance.test` | `password` |

Admin panel: `/admin` · Marketing: `/` `/features` `/modules` `/overtime` `/filings` `/pricing` `/demo`

---

## Business ROI & Time-Saver Opportunities

### Executive outcomes
- **Cut OT exposure** with jurisdiction-priority overtime rules and breach alerts.
- **Reduce misclassification risk** via wage class catalogs linked to employee roster.
- **Ship filings on time** with due-date tracking and late-filing alert sync.
- **Right-size footprint** by disabling AI, catalog scrape, or attendance until needed.

### Department time-savers
| Department | Opportunity | Typical weekly hours unlocked (seed model) |
|---|---|---|
| Payroll | OT calculation & pay period runs | ~28h |
| Compliance | Filings + alerts | ~38h |
| HR | Wage classes & employee roster | ~36h |
| Ops | PDF packs / AI / speed layer | ~34h |

**Compounding effect:** enabled modules estimate **100+ hours/week** of compliance automation capacity in the demo seed.

### Opportunity backlog for implementers
1. Feed time clocks into OT via `imrandevbd/laravel-attendance-hub` when `attendance_ops` is enabled.
2. Draft classification narratives through `imrandevbd/laravel-ai-hub` via AI Payroll Assist.
3. Render multilingual compliance PDFs with `laravel-unicode-pdf`.
4. Enrich wage-board catalogs with `laravel-ai-catalog` scrapers.
5. Accelerate admin delivery with `drutogoti` performance helpers.
6. Extend Filament surfaces using `laravel-admin-panel` patterns.
7. Keep SEO-safe multilingual slugs with `laravel-universal-slug`.

---

## Modules (On / Off)

| Key | Name | Category | Core |
|---|---|---|---|
| `jurisdictions` | Jurisdictions | compliance | Yes |
| `wage_classes` | Wage Classifications | payroll | Yes |
| `overtime_rules` | Overtime Rules | payroll | Yes |
| `employees` | Employee Roster | workforce | Yes |
| `pay_periods` | Pay Periods & Runs | payroll | Yes |
| `filings` | Compliance Filings | compliance | Yes |
| `alerts` | Compliance Alerts | risk | No |
| `pdf_packs` | PDF Compliance Packs | reporting | No |
| `ai_assist` | AI Payroll Assist | ai | No |
| `catalog_scrape` | Labor Catalog Scraper | data | No |
| `attendance_ops` | Attendance Bridge | workforce | No |
| `speed_optimizer` | Drutogoti Speed Layer | platform | No |

`ModuleManager` caches lookups and syncs `module_settings` for Filament + marketing pages.

---

## Domain Model

- **Users** — roles via `UserRole`; Filament access gated by role.
- **ModuleSetting** — feature flags for the payroll stack.
- **Jurisdiction** — authority, currency, minimum wage.
- **WageClassification** — exempt status + pay frequency.
- **OvertimeRule** — thresholds, multipliers, priority.
- **PayrollEmployee** — roster linked to jurisdiction & wage class.
- **PayPeriod** + **PayrollRun** — period totals and per-employee calc.
- **ComplianceFiling** — tax/labor filing lifecycle.
- **ComplianceAlert** — OT / filing / classification risk.
- **PdfCompliancePack** — auditor-ready PDF metadata.

Services: `ModuleManager`, `OvertimeCalculator`, `FilingReminderService`.

---

## Filament Admin Resources

- Jurisdictions · Wage Classes · Overtime Rules · Employees · Pay Periods · Filings · Alerts · PDF Packs · Modules · Users  
- Widgets: **PayrollStatsOverview**, **OpenAlertsWidget**

Brand color: `#CA8A04`.

---

## Public Marketing Pages

| Route | Purpose |
|---|---|
| `/` | Hero + KPI + value props |
| `/features` | Feature cards from module catalog |
| `/modules` | Module on/off matrix |
| `/overtime` | OT engine showcase |
| `/filings` | Filings desk narrative |
| `/pricing` | Starter / Compliance+ / Platform |
| `/demo` | Demo credentials CTA |

---

## Tech Stack & Packages

- PHP 8.3+ · Laravel 13 · Filament 4 · Livewire · SQLite/MySQL  
- Packagist (`dev-main` / aliased for Laravel 13 compatibility where upstream constraints lag):
  - `imrandevbd/drutogoti` — **path shim** `packages/drutogoti` (L13 illuminate bridge)
  - `imrandevbd/laravel-admin-panel` — **path shim** `packages/laravel-admin-panel`
  - `imrandevbd/laravel-attendance-hub` — **path shim** `packages/laravel-attendance-hub`
  - `imrandevbd/laravel-ai-catalog` — Packagist `dev-main`
  - `imrandevbd/laravel-ai-hub` — Packagist `^1.6`
  - `imrandevbd/laravel-unicode-pdf` — Packagist `dev-main`
  - `imrandevbd/laravel-universal-slug` — Packagist `dev-main`

> Note: `drutogoti`, `laravel-admin-panel`, and `laravel-attendance-hub` upstream pins block Laravel 13; this repo ships local path repositories that require `illuminate/support ^11|^12|^13` so `composer install` succeeds while still declaring all seven packages.

---

## Quick Start

```bash
composer install
copy .env.example .env   # Windows
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Visit `http://127.0.0.1:8000` and `http://127.0.0.1:8000/admin`.

### Docker

```bash
docker compose up --build
```

App: `http://localhost:8080` · MySQL published on `3310` · Redis on `6382`.

---

## Testing

```bash
php artisan test
```

---

## Architecture Principles

1. **Modules first** — payroll capabilities are toggleable data, not hard-coded dead ends.
2. **Roles with intent** — Demo can explore; Clients stay out of admin.
3. **Jurisdiction-aware** — OT, wages, and filings always carry locale context.
4. **Measure risk early** — alerts surface OT and filing problems before payroll closes.
5. **Production posture** — Docker, `.env.example`, seeders, services, Filament resources, public SEO pages.

---

## Author

**Imran Ahmed** · [imrandev.bd](https://imrandev.bd) · [me@imrandev.bd](mailto:me@imrandev.bd) · GitHub [@imranbru99](https://github.com/imranbru99)

---

## 🤝 Let's Connect & Collaborate

I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.

Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.

Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---|---|---|
| 🌐 Primary Portfolio | [imrandev.bd](https://imrandev.bd) | [Visit Site ↗](https://imrandev.bd) |
| 📦 Packagist Packages | [packagist.org/packages/imrandevbd/](https://packagist.org/packages/imrandevbd/) | [View Packages ↗](https://packagist.org/packages/imrandevbd/) |
| 💼 LinkedIn Profile | [linkedin.com/in/imranbru99](https://linkedin.com/in/imranbru99) | [Connect ↗](https://linkedin.com/in/imranbru99) |
| 🐙 GitHub Profile | [github.com/imranbru99](https://github.com/imranbru99) | [Follow ↗](https://github.com/imranbru99) |
| 💬 WhatsApp Direct | +880 1576-918420 | [Chat Now ↗](https://wa.me/8801576918420) |
| 📧 Direct Email | me@imrandev.bd | [Send Email ↗](mailto:me@imrandev.bd) |
| 🐦 X (Twitter) | [@imrandev_bd](https://x.com/imrandev_bd) | [Follow ↗](https://x.com/imrandev_bd) |
| 📺 YouTube Tech | [@ImranDevBD](https://youtube.com/@ImranDevBD) | [Subscribe ↗](https://youtube.com/@ImranDevBD) |
