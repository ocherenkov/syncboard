<?php

namespace App\Http\Controllers;

use App\Models\FirmaProduct;
use App\Services\FirmaService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, FirmaService $firmaService, ProductService $productService)
    {
        $selectedCatalog = $request->get('catalog_id');
        $catalogs = $firmaService->getCatalogs();

        $products = FirmaProduct::with(['catalog', 'linkerProduct.linkerOrderProducts.order'])
            ->byCatalog($selectedCatalog)
            ->get();

        $productsData = $productService->prepareProductData($products);

        return view('products.index', [
            'products' => $productsData,
            'catalogs' => $catalogs,
            'selectedCatalog' => $selectedCatalog,
        ]);
    }
}
