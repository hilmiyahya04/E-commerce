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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary Key

            $table->unsignedBigInteger('userId'); // Foreign Key ke users
            $table->date('orderDate')->nullable();
            $table->string('paymentMethod', 50)->nullable();
            $table->string('orderStatus', 50)->nullable();
            $table->string('id_pemesanan', 50)->unique(); // No ID Pemesanan

            // Foreign Key
            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
