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
        Schema::create('product_order_track_histories', function (Blueprint $table) {
            $table->id(); // Primary Key

            $table->unsignedBigInteger('orderId'); // FK ke orders
            $table->string('status', 50);          // status pesanan
            $table->string('remarks', 255)->nullable(); // keterangan tambahan

            // Foreign Key
            $table->foreign('orderId')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps(); // waktu perubahan status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_order_track_histories');
    }
};
