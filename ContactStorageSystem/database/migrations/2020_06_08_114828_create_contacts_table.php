<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('status_id')->unsigned();;
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
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
        Schema::dropIfExists('contacts');
    }
}
