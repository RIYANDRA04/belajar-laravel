<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 12, 0);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('category'); // Running, Lifestyle, Basket, Training
            $table->json('sizes');      // ["38","39","40","41","42"]
            $table->json('colors')->nullable(); // ["Hitam","Putih","Merah"]
            $table->json('color_images')->nullable(); // Mapping color to image url
            $table->string('material')->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
