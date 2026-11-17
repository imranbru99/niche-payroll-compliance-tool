<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'name', 'description', 'category', 'enabled', 'is_core', 'hours_saved_weekly'])]
class ModuleSetting extends Model
{
    protected function casts(): array
    {
        return [
            'enabled' => 'boolean',
            'is_core' => 'boolean',
            'hours_saved_weekly' => 'integer',
        ];
    }
}
