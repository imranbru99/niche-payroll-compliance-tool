<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'employee_number', 'full_name', 'email', 'jurisdiction_id', 'wage_classification_id',
    'manager_id', 'hourly_rate', 'status', 'hired_on', 'notes',
])]
class PayrollEmployee extends Model
{
    protected function casts(): array
    {
        return [
            'hourly_rate' => 'decimal:2',
            'hired_on' => 'date',
        ];
    }

    public function jurisdiction(): BelongsTo
    {
        return $this->belongsTo(Jurisdiction::class);
    }

    public function wageClassification(): BelongsTo
    {
        return $this->belongsTo(WageClassification::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function payrollRuns(): HasMany
    {
        return $this->hasMany(PayrollRun::class);
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(ComplianceAlert::class);
    }
}
