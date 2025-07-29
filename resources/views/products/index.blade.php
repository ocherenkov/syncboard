<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('products.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container mt-4">

    <form method="GET" class="mb-3">
        <label for="catalog">{{ __('products.filter.label') }}:</label>
        <select name="catalog_id" id="catalog" class="form-select" onchange="this.form.submit()">
            <option value="">{{ __('products.filter.all') }}</option>
            @foreach ($catalogs as $catalog)
                <option value="{{ $catalog->id }}" @selected($selectedCatalog == $catalog->id)>
                    {{ $catalog->name }}
                </option>
            @endforeach
        </select>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>{{ __('products.table.id') }}</th>
            <th>{{ __('products.table.name') }}</th>
            <th>{{ __('products.table.sku') }}</th>
            <th>{{ __('products.table.quantity') }}</th>
            <th>{{ __('products.table.price') }}</th>
            <th>{{ __('products.table.total_sales') }}</th>
            <th>{{ __('products.table.avg_sales') }}</th>
            <th>{{ __('products.table.sales_by_source') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->firma_id }} / {{ $product->linker_id ?? __("products.not_available") }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}<br>{{ $product->ean }}</td>
                <td>
                    {{ $product->firma_quantity }} /
                    <span
                        @class(['text-danger' => $product->linker_quantity !== null && $product->linker_quantity != $product->firma_quantity])
                    >
                            {{ $product->linker_quantity ?? __("products.not_available") }}
                        </span>
                </td>
                <td>
                    {{ $product->firma_price }} /
                    <span
                        @class(['text-danger' => $product->linker_price !== null && $product->linker_price != $product->firma_price])
                    >
                            {{ $product->linker_price ?? __("products.not_available") }}
                        </span>
                </td>
                <td>{{ $product->total_sales }}</td>
                <td>{{ number_format($product->avg_sales, 2) }}</td>
                <td>
                    @foreach ($product->sales_by_sources as $src => $count)
                        <div>{{ ucfirst($src) }}: {{ $count }}</div>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
