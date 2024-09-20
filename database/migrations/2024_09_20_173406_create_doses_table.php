<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doses', function (Blueprint $table) {
            $table->foreignId('medicine_id')->constrained('medicines');
            $table->foreignUuid('employee_cpf')->constrained('employees', 'cpf');
            $table->date('date_applyed');
            $table->enum('dose_sequence', ['first', 'second', 'third']);
            $table->primary(['dose_sequence', 'employee_cpf']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doses');
    }
};
