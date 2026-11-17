<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'code', 'name', 'country_code', 'region', 'authority_name',
    'currency_code', 'minimum_wage', 'is_active', 'meta',
])]
class Jurisdiction extends Model
{
    protected function casts(): array
    {
        return [
            'minimum_wage' => 'decimal:2',
            'is_active' => 'boolean',
            'meta' => 'array',
        ];
    }

    public function wageClassifications(): HasMany
    {
        return $this->hasMany(WageClassification::class);
    }

    public function overtimeRules(): HasMany
    {
        return $this->hasMany(OvertimeRule::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(PayrollEmployee::class);
    }

    public function filings(): HasMany
    {
        return $this->hasMany(ComplianceFiling::class);
    }
}
