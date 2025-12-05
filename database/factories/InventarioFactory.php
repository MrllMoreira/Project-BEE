<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome'        => fake()->words(2, true),
            'descricao'   => fake()->sentence(),
            'status'      => fake()->randomElement([
                'Ativo',
                'Inativo',
                'Manutenção',
            ]),
            'unidade_id'  => null,
            'created_by'  => null,
            'updated_by'  => null,

        ];
    }
}
