<?php

namespace App\Models;

use App\Enums\OrderSourceEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'total',
        'date',
    ];

    protected $casts = [
        'source' => OrderSourceEnum::class,
    ];

    public function orderProducts(): HasMany
    {
        return $this->hasMany(LinkerOrderProduct::class);
    }
}
