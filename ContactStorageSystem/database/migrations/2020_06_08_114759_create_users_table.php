<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('status_id')->unsigned()->default(1)->change();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('house_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
