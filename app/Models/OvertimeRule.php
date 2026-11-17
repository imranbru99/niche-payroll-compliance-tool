<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'jurisdiction_id', 'name', 'slug', 'daily_threshold_hours', 'weekly_threshold_hours',
    'overtime_multiplier', 'double_time_multiplier', 'priority', 'is_active', 'notes',
])]
class OvertimeRule extends Model
{
    protected function casts(): array
    {
        return [
            'daily_threshold_hours' => 'decimal:2',
            'weekly_threshold_hours' => 'decimal:2',
            'overtime_multiplier' => 'decimal:2',
            'double_time_multiplier' => 'decimal:2',
            'priority' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function jurisdiction(): BelongsTo
    {
        return $this->belongsTo(Jurisdiction::class);
    }
}
