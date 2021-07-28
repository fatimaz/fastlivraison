<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
              $table->increments('id');
            // $table->unsignedBigInteger('driver_id')->unsigned();
            $table->integer('from')->unsigned();
            $table->integer('to')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->date('travel_date')->nullable();
            $table->integer('weight_total');
            $table->integer('weight_free');
            $table->text('note');
            $table->boolean('is_active');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('to')->references('id')->on('countries')->onDelete('cascade');

            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
