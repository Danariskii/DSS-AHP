<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Table_Saran', function (Blueprint $table) {
            $table->increments('id');

            $table->string('JwbPertanyaan1')->nullable();
            $table->string('JwbPertanyaan2')->nullable();
            $table->string('JwbPertanyaan3')->nullable();
            $table->string('JwbPertanyaan4')->nullable();
            $table->string('JwbPertanyaan5')->nullable();
            $table->string('JwbPertanyaan6')->nullable();
            $table->text('Saran')->nullable();

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
        Schema::drop('Table_Saran');
    }
}
