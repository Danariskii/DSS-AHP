<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrixSubKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Table_Matrix_SubKriteria', function (Blueprint $table) {
            $table->increments('id');

            $table->string('Nama_Matrix_SubKriteria');
            $table->integer('Nilai_Matrix_SubKriteria')->nullable();

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
        Schema::drop('=Table_Matrix_SubKriteria');
    }
}
