<?php

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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('orderId')->nullable();   // FK ke orders
            $table->unsignedBigInteger('productId'); // FK ke products
            $table->integer('quantity'); // jumlah produk

            // Foreign Key
            $table->foreign('orderId')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('productId')
                ->references('id')
                ->on('product')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
