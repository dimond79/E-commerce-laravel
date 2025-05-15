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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // string = 255
            // $table->unsignedBigInteger('category_id');
            $table->foreignId('category_id')->references('id')
            ->on('product_categories')->onDelete('cascade');
            $table->text('description')->nullable(); // text = any
            $table->boolean('is_featured')->nullable()->default(false);
            $table->decimal('price',10,2);
            $table->decimal('sale_price',10,2);
            $table->bigInteger('qty');
            $table->string('featured_image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
