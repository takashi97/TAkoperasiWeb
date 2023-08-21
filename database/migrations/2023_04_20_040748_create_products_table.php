<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('p_name');
            $table->string('image_produk')->nullable();
            $table->string('j_produk');
            $table->integer('h_produk');
            $table->string('k_produk');
            $table->integer('s_produk');
            $table->float('b_produk', 5,2);
            $table->string('d_produk', 2000);
            $table->string('identifier')->unique();
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
        Schema::dropIfExists('products');
    }
};
