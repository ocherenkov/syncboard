<?php

namespace App\Services;

use App\Models\FirmaProduct;
use App\Models\LinkerOrder;
use App\Models\LinkerOrderProduct;
use App\Models\LinkerProduct;
use Illuminate\Support\Collection;

class LinkerService
{
    public function getProducts(): Collection
    {
        return LinkerProduct::with('firmaProduct')->get();
    }

    public function getOrders(): Collection
    {
        return LinkerOrder::with('linkerOrderProducts')->get();
    }

    public function getOrderProducts(): Collection
    {
        return LinkerOrderProduct::with(['order', 'product'])->get();
    }

    public function sync(): void
    {
        FirmaProduct::all()->each(function ($firmaProduct) {
            LinkerProduct::query()->updateOrCreate(
                ['firma_product_id' => $firmaProduct->id],
                [
                    'name' => $firmaProduct->name,
                    'sku' => $firmaProduct->sku,
                    'ean' => $firmaProduct->ean,
                    'price' => $firmaProduct->price * (rand(90, 110) / 100),
                    'quantity' => max(0, $firmaProduct->quantity + rand(-5, 5)),
                ]
            );
        });

        LinkerOrder::factory(1000)->create()->each(function ($order) {
            $products = LinkerProduct::query()->inRandomOrder()->take(rand(1, 5))->get();

            foreach ($products as $product) {
                LinkerOrderProduct::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => rand(1, 30),
                ]);
            }
        });
    }
}
