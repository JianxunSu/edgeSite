<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('store', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('region', 8);
            $table->string('ship_address', 255);
            $table->string('ship_city', 255);
            $table->string('ship_state', 255);
            $table->string('ship_zip', 15);
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
        });
        Schema::create('supervisor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 64)->nullable();
            $table->string('lastname', 64)->nullable();
            $table->string('email', 255)->unique();
            $table->string('region', 8);
            $table->unsignedInteger('store_id')->default(0)->index();
            // $table->foreign('store_id')->references('id')->on('store');
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
        Schema::dropIfExists('supervisor');
        Schema::dropIfExists('store');
    }
}
