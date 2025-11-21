<?php

namespace Database\Factories;

use App\Models\Assinatura;
use App\Models\User;
use App\Models\Documento;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssinaturaFactory extends Factory
{
    protected $model = Assinatura::class;

    public function definition(): array
    {
        $assinou = $this->faker->boolean(80); // 80% das assinaturas são verdadeiras

        return [
            'assinado' => $assinou,
            'assinado_em' => null,

            'assinado_por' => User::factory(),
            'documento_id' => Documento::factory(),
        ];
    }
}
