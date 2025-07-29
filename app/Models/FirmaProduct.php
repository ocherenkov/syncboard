<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FirmaProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'ean',
        'price',
        'quantity',
        'catalog_id',
    ];

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(FirmaCatalog::class, 'catalog_id');
    }

    public function linkerProduct(): HasOne
    {
        return $this->hasOne(LinkerProduct::class, 'firma_product_id');
    }

    #[Scope]
    protected function byCatalog(Builder $query, ?int $catalogId): Builder
    {
        return $catalogId ? $query->where('catalog_id', $catalogId) : $query;
    }
}
