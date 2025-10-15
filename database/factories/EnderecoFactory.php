<?php

namespace Database\Factories;

use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Endereco::class;
    public function definition(): array
    {
        return [
            'uf' => "SP",
            'regiao' => "Sudeste",
            'cidade' => "São Paulo",
            'bairro' => "Bairro",
            'rua' => "Rua",
            'numero' => 1,
            'complemento' => "Complemento",
            'cep' => "12345-678",
        ];
    }
}
