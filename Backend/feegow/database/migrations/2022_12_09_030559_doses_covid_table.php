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
        Schema::create('dose_vacina_covid', function (Blueprint $table) {
            $table->id();
            $table->string('idFuncionario');
            $table->timestamp('dtDoseCovid');
            $table->string('nome');
            $table->string('lote');
            $table->timestamp('dtValidade')->nullable();
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
        //
    }
};
