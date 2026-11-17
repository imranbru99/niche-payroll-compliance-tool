<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'pay_period_id', 'payroll_employee_id', 'regular_hours', 'ot_hours',
    'gross_pay', 'ot_pay', 'status', 'calc_meta',
])]
class PayrollRun extends Model
{
    protected function casts(): array
    {
        return [
            'regular_hours' => 'decimal:2',
            'ot_hours' => 'decimal:2',
            'gross_pay' => 'decimal:2',
            'ot_pay' => 'decimal:2',
            'calc_meta' => 'array',
        ];
    }

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(PayrollEmployee::class, 'payroll_employee_id');
    }
}
