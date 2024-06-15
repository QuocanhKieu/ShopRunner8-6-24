<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_comments', function (Blueprint $table) {
            $table->integer('status')->default(0);
            $table->text('shop_response')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_comments', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('shop_response');
            $table->dropSoftDeletes();
        });
    }
}
