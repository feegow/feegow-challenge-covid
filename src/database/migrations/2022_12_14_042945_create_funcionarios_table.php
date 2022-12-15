<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacinaAplicada_id')->nullable();
            $table->boolean('vacinaAplicada');
            $table->string('nomeCompleto');
            $table->string('cpf')->unique();
            $table->boolean('portadorComorbidade');
            $table->date('dataNascimento');
            $table->date('dataPrimeiraDose')->nullable();
            $table->date('dataSegundaDose')->nullable();
            $table->date('dataTerceiraDose')->nullable();
            $table->timestamps();
        });

        Schema::table('funcionarios', function($table) {
            $table->foreign('vacinaAplicada_id')->references('id')->on('vacinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
