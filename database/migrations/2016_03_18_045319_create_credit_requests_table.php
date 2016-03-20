<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('phone',10);
            $table->string('message', 255);
            $table->uuid('request_uuid');
            $table->string('request_response',500);
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
        Schema::drop('credit_requests');
    }
}
