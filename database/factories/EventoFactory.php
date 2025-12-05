<?php

namespace Database\Factories;

use App\Models\EventoTipo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement([
                'Pendente',
                'Em análise',
                'Concluído'
            ]),

            'dados' => [
                'observacao' => fake()->sentence(),
                'responsavel' => fake()->name(),
                'departamento' => fake()->word()
            ],

            'evento_tipo_id' => null,
            'criado_por' => null,
        ];
    }
}
