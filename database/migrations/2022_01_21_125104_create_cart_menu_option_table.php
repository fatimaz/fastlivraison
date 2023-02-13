<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartMenuOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_menu_option', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('option_id')->unsigned();
            $table->integer('cart_menu_id')->unsigned();
            $table->timestamps();           
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('cart_menu_id')->references('id')->on('cart_menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_menu_option');
    }
}
