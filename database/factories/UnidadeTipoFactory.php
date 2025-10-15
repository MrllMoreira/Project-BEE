<?php

namespace Database\Factories;

use App\Models\UnidadeTipo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UnidadeTipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = UnidadeTipo::class;
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'descricao' => fake()->text(),
        ];
    }
}
