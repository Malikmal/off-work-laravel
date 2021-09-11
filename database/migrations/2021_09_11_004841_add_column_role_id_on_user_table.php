<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRoleIdOnUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->index();

            $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade')
                    ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('role_id');
            $table->dropIndex('role_id');
            $table->dropColumn('role_id');
        });
    }
}
