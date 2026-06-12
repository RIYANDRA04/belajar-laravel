<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('color')->nullable()->after('product_id');
            $table->text('image_url')->nullable()->after('color');
            $table->string('image_filter')->nullable()->after('image_url');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['color', 'image_url', 'image_filter']);
        });
    }
};
