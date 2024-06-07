<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add foreign key with explicit names to avoid conflicts
            $table->foreign('brand_id', 'fk_products_brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade'); // Or any other action you need

            $table->foreign('product_category_id', 'fk_products_product_category_id')
                ->references('id')
                ->on('product_categories')
                ->onDelete('cascade'); // Or any other action you need
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign keys by their explicit names
            $table->dropForeign('fk_products_brand_id');
            $table->dropForeign('fk_products_product_category_id');
        });
    }
};
