<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'reference', 'jurisdiction_id', 'pay_period_id', 'owner_id', 'title',
    'filing_type', 'status', 'due_on', 'submitted_at', 'confirmation_code', 'notes',
])]
class ComplianceFiling extends Model
{
    protected function casts(): array
    {
        return [
            'due_on' => 'date',
            'submitted_at' => 'datetime',
        ];
    }

    public function jurisdiction(): BelongsTo
    {
        return $this->belongsTo(Jurisdiction::class);
    }

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
