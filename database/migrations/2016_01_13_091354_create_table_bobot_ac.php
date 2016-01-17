<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBobotAc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Table_Bobot_AC', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_AC')->unsigned();
            $table->foreign('id_AC')->references('id')->on('Table_AC');

            $table->string('Model')->nullable();

            $table->integer('Capasitas')->nullable();
            $table->integer('Garansi')->nullable();
            $table->integer('Perawatan')->nullable();
            $table->integer('Fitur')->nullable();
            $table->integer('Listrik')->nullable();
            $table->integer('Desain')->nullable();
            $table->integer('Ketahanan')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Table_Bobot_AC');
    }
}
