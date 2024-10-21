<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Tipo de relatório, ex: 'unvaccinated_employees'
            $table->string('status')->default('queued'); // Status: queued, processing, completed, failed
            $table->string('file_path')->nullable(); // Caminho do arquivo gerado
            $table->unsignedBigInteger('user_id'); // Usuário que solicitou o relatório
            $table->timestamp('completed_at')->nullable(); // Data de conclusão
            $table->timestamps(); // Criação e atualização
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
