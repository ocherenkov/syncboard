<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkerOrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(LinkerOrder::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(LinkerProduct::class, 'product_id');
    }

    #[Scope]
    protected function totalSales(Builder $query): int
    {
        return $query->sum('quantity');
    }

    #[Scope]
    protected function salesLast7Days($query)
    {
        return $query->whereHas('order', function ($query) {
            $query->where('date', '>=', now()->subDays(7));
        })->avg('quantity');
    }

    #[Scope]
    protected function salesBySource($query)
    {
        return $query->with('order.source')
            ->get()
            ->groupBy(fn($op) => $op->order->source->value)
            ->map(fn($items) => $items->sum('quantity'));
    }

}
