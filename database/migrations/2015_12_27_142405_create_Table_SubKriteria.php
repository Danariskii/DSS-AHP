<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Table_SubKriteria', function (Blueprint $table) {
            $table->increments('id');

            $table->string('Nama_SubKriteria');
            $table->integer('Nilai_Bobot_SubKriteria')->nullable();

            $table->string('Nama_Kriteria')->nullable;

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
        Schema::drop('Table_SubKriteria');
    }
}
