<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_method');
            $table->integer('shipping_cost');
            $table->timestamps();
        });

        // Insert dummy shipping options
        DB::table('shippings')->insert([
            ['shipping_method' => 'Standard Shipping', 'shipping_cost' => 50000],
            ['shipping_method' => 'Express Shipping', 'shipping_cost' => 100000],
            ['shipping_method' => 'Free Shipping', 'shipping_cost' => 0],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}