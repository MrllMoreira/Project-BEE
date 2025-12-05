<?php

namespace Database\Factories;

use App\Models\Unidade;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Unidade>
 */
class UnidadeFactory extends Factory
{
    protected $model = Unidade::class;

    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'codigo_unidade' => Str::random(10),
            'telefone' => fake()->phoneNumber(),
            'celular' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'ensino_tipo' => fake()->randomElement(['Fundamental I', 'Fundamental II', 'Fundamental I e II']),
            'endereco_id' => rand(1, 10),
            'created_by' => null,
            'updated_by' => null,
            'responsavel' => null,
        ];
    }
}
