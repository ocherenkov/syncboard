<?php

namespace App\Services;

use App\Models\FirmaCatalog;
use App\Models\FirmaProduct;
use Illuminate\Support\Collection;

class FirmaService
{
    public function getCatalogs(): Collection
    {
        return FirmaCatalog::all(['id', 'name']);
    }

    public function getProducts(): Collection
    {
        return FirmaProduct::with('catalog')
            ->select(['id', 'name', 'sku', 'ean', 'price', 'quantity', 'catalog_id'])
            ->get();
    }

    public function sync(): void
    {
        FirmaCatalog::factory(50)
            ->has(FirmaProduct::factory(rand(100, 300)), 'products')
            ->create();
    }
}
