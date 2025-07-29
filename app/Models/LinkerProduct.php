<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkerProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'ean',
        'price',
        'quantity',
        'firma_product_id',
    ];

    public function firmaProduct(): BelongsTo
    {
        return $this->belongsTo(FirmaProduct::class, 'firma_product_id');
    }

    public function linkerOrderProducts(): HasMany
    {
        return $this->hasMany(LinkerOrderProduct::class, 'product_id');
    }
}
