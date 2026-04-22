<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Relasi ke orders
            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            // Relasi ke product
            $table->foreignId('product_id')
                ->constrained('product')
                ->cascadeOnDelete();

            // Snapshot data produk saat dibeli
            $table->string('product_name');
            $table->integer('price');

            // Jumlah & subtotal        
            $table->integer('qty');
            $table->integer('subtotal')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
