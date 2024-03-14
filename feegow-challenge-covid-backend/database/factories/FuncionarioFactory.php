<?php

namespace Database\Factories;

use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionarioFactory extends Factory
{
    protected $model = Funcionario::class;

    public function definition()
    {
        return [
            'cpf' => $this->faker->unique()->numerify('###########'),
            'nome_completo' => $this->faker->name,
            'data_nascimento' => $this->faker->date(),
            'portador_comorbidade' => $this->faker->boolean(25), // 25% de chance de ser verdadeiro
        ];
    }
}
