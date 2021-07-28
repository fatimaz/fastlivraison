<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('from')->unsigned();
              $table->integer('to')->unsigned();
            // $table->unsignedBigInteger('driver_id')->unsigned();
             $table->date('expected_date')->nullable();
             $table->string('link');
             $table->string('name');
             $table->string('photo');
        
             $table->decimal('price', 18, 4)->unsigned();
             $table->integer('weight');
             $table->integer('qty');
             $table->text('description');
              $table->boolean('is_active');
              
             $table->integer('category_id')->unsigned();
             $table->unsignedBigInteger('user_id')->unsigned(); 
            
             $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('from')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('to')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::dropIfExists('shipments');
    }
}
