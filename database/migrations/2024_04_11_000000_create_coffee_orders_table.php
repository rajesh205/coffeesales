<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('coffee_orders', function(Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->integer('quantity');
            $table->float('unit_price');
            $table->float('selling_price');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coffee_orders');
    }
};