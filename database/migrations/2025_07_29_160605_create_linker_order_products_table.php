<?php

use App\Models\LinkerOrder;
use App\Models\LinkerProduct;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('linker_order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LinkerOrder::class, 'order_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(LinkerProduct::class, 'product_id')->index()->constrained()->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linker_order_products');
    }
};
