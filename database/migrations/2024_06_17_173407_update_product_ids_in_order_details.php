<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class UpdateProductIdsInOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update product_id to a random value between 1 and 25
        DB::table('order_details')->update([
            'product_id' => DB::raw('FLOOR(1 + RAND() * 25)')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // It's not possible to revert this change exactly,
        // so this section is intentionally left blank.
    }
}
