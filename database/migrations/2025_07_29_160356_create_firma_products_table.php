<?php

use App\Models\FirmaCatalog;
use App\Models\FirmaProduct;
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
        Schema::create('firma_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('ean')->nullable();
            $table->decimal('price', 10);
            $table->unsignedInteger('quantity');
            $table->foreignIdFor(FirmaCatalog::class, 'catalog_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firma_products');
    }
};
