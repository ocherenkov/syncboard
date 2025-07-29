<?php

namespace App\Services;

use Illuminate\Support\Collection;

class ProductService
{
    public function prepareProductData(Collection $products): Collection
    {
        return $products->map(function ($product) {
            $linker = $product->linkerProduct;
            $orderProducts = $linker?->linkerOrderProducts ?? collect();

            return $this->buildProductData($product, $linker, $orderProducts);
        });
    }

    private function buildProductData($product, $linker, $orderProducts): object
    {
        return (object)[
            'firma_id' => $product->id,
            'linker_id' => $linker?->id,
            'name' => $product->name,
            'sku' => $product->sku,
            'ean' => $product->ean,
            'firma_quantity' => $product->quantity,
            'linker_quantity' => $linker?->quantity,
            'firma_price' => $product->price,
            'linker_price' => $linker?->price,
            'total_sales' => $this->calculateTotalSales($orderProducts),
            'avg_sales' => $this->calculateSalesLast7Days($orderProducts),
            'sales_by_sources' => $this->calculateSalesBySource($orderProducts),
        ];
    }

    private function calculateTotalSales(Collection $orderProducts): int
    {
        return $orderProducts->sum('quantity');
    }

    private function calculateSalesLast7Days(Collection $orderProducts): float
    {
        return $orderProducts
            ->filter(fn($op) => $op->order->date >= now()->subDays(7))
            ->avg('quantity') ?: 0;
    }

    private function calculateSalesBySource(Collection $orderProducts): Collection
    {
        return $orderProducts
            ->groupBy(fn($op) => $op->order->source->value)
            ->map(fn($items) => $items->sum('quantity'));
    }

}
