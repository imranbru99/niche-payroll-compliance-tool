<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'reference', 'jurisdiction_id', 'starts_on', 'ends_on', 'pay_date', 'status',
    'employee_count', 'gross_total', 'ot_total', 'notes',
])]
class PayPeriod extends Model
{
    protected function casts(): array
    {
        return [
            'starts_on' => 'date',
            'ends_on' => 'date',
            'pay_date' => 'date',
            'employee_count' => 'integer',
            'gross_total' => 'decimal:2',
            'ot_total' => 'decimal:2',
        ];
    }

    public function jurisdiction(): BelongsTo
    {
        return $this->belongsTo(Jurisdiction::class);
    }

    public function payrollRuns(): HasMany
    {
        return $this->hasMany(PayrollRun::class);
    }

    public function filings(): HasMany
    {
        return $this->hasMany(ComplianceFiling::class);
    }
}
