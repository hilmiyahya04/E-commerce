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
        Schema::create('product', function (Blueprint $table) {
            $table->id(); // id (Primary Key)
            $table->string('productCode', 50)->unique();
            $table->string('productName', 100);
            $table->string('productCompany', 100)->nullable();
            $table->integer('productPrice');
            $table->string('productImage1', 255)->nullable();
            $table->string('productAvailability', 50)->nullable();
            $table->date('postingDate')->nullable();
            $table->unsignedBigInteger('categoryId')->nullable();

            // Foreign Key
            $table->foreign('categoryId')
                ->references('id')
                ->on('categories')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
