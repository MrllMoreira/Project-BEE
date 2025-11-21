<?php

namespace Database\Factories;

use App\Models\Evento;
use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipamentoEventoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'evento_id' => Evento::factory(),
            'equipamento_id' => Equipamento::factory(),
        ];
    }
}
