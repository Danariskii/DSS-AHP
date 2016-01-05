<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Table_Kriteria', function (Blueprint $table) {
            $table->increments('id');

            $table->string('Nama_Kriteria');
            $table->integer('Nilai_Bobot_Kriteria')->nullable();
            $table->integer('Jumlah_SubKriteria')->nullable();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('=Table_Kriteria');
    }
}
