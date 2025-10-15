<?php

namespace Database\Seeders;

use App\Models\Endereco;
use App\Models\Unidade;
use App\Models\UnidadeTipo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Endereco::factory(10)->create();
        UnidadeTipo::factory(10)->create();
        $unidades = Unidade::factory(10)->create(['created_by' => null]);

        $users = User::factory(10)->create([
            'unidade_id' => $unidades->random()->id, // pega uma unidade aleatória
        ]);


    }
}
