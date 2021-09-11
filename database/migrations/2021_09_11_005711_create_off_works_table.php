<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('off_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->index();
            $table->string('description');
            $table->date('date_start');
            $table->date('date_end');
            $table->unsignedBigInteger('accepted_by')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ;
            $table->foreign('accepted_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
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
        Schema::dropIfExists('off_works');
    }
}
