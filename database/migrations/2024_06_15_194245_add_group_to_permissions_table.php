<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupToPermissionsTable  extends Migration
{
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Add group column
            $table->string('group')->nullable();

            // Add description column
            $table->text('description')->nullable();

            // Add soft delete column
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Reverse the operations in the "up" method
            $table->dropColumn('group');
            $table->dropColumn('description');
            $table->dropSoftDeletes();
        });
    }
}
