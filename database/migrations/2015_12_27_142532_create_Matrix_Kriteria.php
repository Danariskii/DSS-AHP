<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrixKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Table_Matrix_Kriteria', function (Blueprint $table) {
            $table->increments('id');

            $table->string('Nama_Matrix_Kriteria');
            $table->string('Nama_Matrix_Pasangan_Kriteria');
            $table->float('Nilai_Matrix_Kriteria')->nullable();

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
        Schema::drop('Table_Matrix_Kriteria');
    }
}
