<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_questionnaire', function (Blueprint $table) {
            $table->increments('id');

            $table->string('Pertanyaan')->nullable();
            $table->string('Jumlah_Sangat_Setuju')->nullable();
            $table->string('Jumlah_Setuju')->nullable();
            $table->string('Jumlah_Netral')->nullable();
            $table->string('Jumlah_Tidak_Setuju')->nullable();
            $table->string('Jumlah_Sangat_Tidak_Setuju')->nullable();

            $table->string('Jumlah_Koresponden')->nullable();

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
        Schema::drop('table_questionnaire');
    }
}
