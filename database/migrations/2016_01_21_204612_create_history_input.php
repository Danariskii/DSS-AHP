<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryInput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_history', function (Blueprint $table) {
            $table->increments('id');

            $table->string('Hasil_Rekomendasi')->nullable();

            $table->string('Jumlah_Kriteria')->nullable();
            $table->string('Jumlah_Alternatif')->nullable();

            $table->string('Capasitas')->nullable();
            $table->string('Garansi')->nullable();
            $table->string('Perawatan')->nullable();
            $table->string('Fitur')->nullable();
            $table->string('Listrik')->nullable();
            $table->string('Desain')->nullable();
            $table->string('Ketahanan')->nullable();

            $table->Timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('table_history');
    }
}
