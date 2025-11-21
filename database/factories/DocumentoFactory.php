<?php

namespace Database\Factories;

use App\Models\Documento;
use App\Models\DocumentoTipo;
use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentoFactory extends Factory
{
    protected $model = Documento::class;

    public function definition(): array
    {
        return [
            'nome' => fake()->sentence(2),
            'status' => fake()->randomElement([
                'Concluido', 'Pendente'
            ]),
            'documento_path' => 'storage/documentos/' . fake()->uuid . '.pdf',

            
            'documento_tipo_id' => DocumentoTipo::factory(),
            'evento_id' => Evento::factory(),
        ];
    }
}
