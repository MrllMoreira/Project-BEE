<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipamentoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->randomElement([
                'Notebook', 'Projetor', 'Impressora', 'Switch', 'Roteador',
                'CPU', 'Monitor', 'Teclado', 'Mouse', 'Servidor'
            ]),

            'codigo_patrimonio' => fake()->unique()->bothify('PAT-####'),

            'descricao' => fake()->sentence(),

            'marca' => fake()->randomElement([
                'HP', 'Dell', 'Lenovo', 'Samsung', 'LG', 'Apple', 'Cisco'
            ]),

            'categoria' => fake()->randomElement([
                'Computador',
                'Periférico',
                'Rede',
                'Audiovisual',
                'Impressão'
            ]),

            'status' => fake()->randomElement([
                'Ativo',
                'Inativo',
                'Manutencao',
                'Descartado'
            ]),

            'inventario_id' => Inventario::factory(),
            'created_by' => fake()->boolean(70)
                ? User::factory()
                : null,
        ];
    }
}
