<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'jurisdiction_id', 'code', 'name', 'exempt_status', 'base_rate',
    'pay_frequency', 'description', 'is_active',
])]
class WageClassification extends Model
{
    protected function casts(): array
    {
        return [
            'base_rate' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function jurisdiction(): BelongsTo
    {
        return $this->belongsTo(Jurisdiction::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(PayrollEmployee::class);
    }
}
