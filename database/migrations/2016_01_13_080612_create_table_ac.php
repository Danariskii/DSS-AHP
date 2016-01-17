<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Table_AC', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('Merek')->nullable();
            $table->string('Model')->nullable();
            $table->string('Harga')->nullable();

            $table->string('Capasitas')->nullable();
            $table->string('Garansi')->nullable();
            $table->string('Perawatan')->nullable();
            $table->string('Fitur')->nullable();
            $table->string('Listrik')->nullable();
            $table->string('Desain')->nullable();
            $table->string('Ketahanan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Table_AC');
    }
}
