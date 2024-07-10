<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    public const ACTIVE = 1;
    public const INACTIVE = 2;

    use HasFactory;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
