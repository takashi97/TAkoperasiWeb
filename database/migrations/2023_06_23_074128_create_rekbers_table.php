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
        Schema::create('rekbers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('rekber_saldo')->default(5000000);
        });

        // Insert a record for Rekber saldo with ID 1
        DB::table('rekbers')->insert([
            'id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekbers');
    }
};
