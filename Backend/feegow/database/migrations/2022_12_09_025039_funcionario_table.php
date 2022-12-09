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
        Schema::create('funcionario', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf', 14)->unique();
            $table->timestamp('dtNascimento');
            $table->timestamp('idPrimeiraDoseCovid')->nullable();
            $table->timestamp('idSegundaDoseCovid')->nullable();
            $table->timestamp('idTereceiraDoseCovid')->nullable();
            $table->boolean('comorbidade');
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
