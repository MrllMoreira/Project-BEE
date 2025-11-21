<?php

namespace Database\Seeders;

use App\Models\Assinatura;
use App\Models\Documento;
use App\Models\DocumentoTipo;
use App\Models\Endereco;
use App\Models\Role;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Inventario;
use App\Models\Equipamento;
use App\Models\EquipamentoEvento;
use App\Models\Evento;
use App\Models\EventoTipo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'funcionario', 'secretaria', 'diretor'];
        foreach ($roles as $role) {
            Role::updateOrCreate(['nome' => $role]);
        }

        $documentoTipos = [
            ['nome' => 'Transferência', 'descricao' => 'Documento usado para registrar a transferência de equipamentos entre unidades.'],
            ['nome' => 'Descarte', 'descricao' => 'Documento para registrar o descarte de equipamentos.'],
            ['nome' => 'Entrada', 'descricao' => 'Documento para registrar a entrada de novos equipamentos no inventário.'],
        ];

        foreach ($documentoTipos as $tipo) {
            DocumentoTipo::updateOrCreate(
                ['nome' => $tipo['nome']],
                ['descricao' => $tipo['descricao']]
            );
        }

        $tiposFixos = [
            ['nome' => 'Transferência', 'descricao' => 'Evento onde equipamentos são movidos entre unidades.'],
            ['nome' => 'Descarte', 'descricao' => 'Evento onde um equipamento é removido do inventário.'],
            ['nome' => 'Entrada', 'descricao' => 'Evento de entrada de novos equipamentos.'],
        ];

        foreach ($tiposFixos as $tipo) {
            EventoTipo::updateOrCreate(
                ['nome' => $tipo['nome']],
                ['descricao' => $tipo['descricao']]
            );
        }

        Endereco::factory(10)->create();

        $unidades = Unidade::factory(10)->create(['created_by' => null]);

        $users = User::factory(10)->create();

        $unidades->each(function ($unidade) use ($users) {
            $inventario = Inventario::factory()->create([
                'unidade_id' => $unidade->id,
                'created_by' => $users->random()->id,
                'updated_by' => $users->random()->id,
            ]);

            Equipamento::factory(20)->create([
                'inventario_id' => $inventario->id,
                'created_by'   => $users->random()->id,
            ]);
        });

        $tipos = EventoTipo::all();
        $usuarios = User::all();

        Evento::factory(20)->create()->each(function ($evento) use ($tipos, $usuarios) {
            $evento->update([
                'evento_tipo_id' => $tipos->random()->id,
                'criado_por'     => $usuarios->random()->id,
            ]);
        });

        $eventos = Evento::all();
        $equipamentos = Equipamento::all();

        foreach ($eventos as $evento) {
            EquipamentoEvento::factory(rand(1, 5))->create([
                'evento_id'      => $evento->id,
                'equipamento_id' => $equipamentos->random()->id,
            ]);
        }

        Documento::factory()->count(20)->create();

        $documentos = Documento::all();
        $usuarios = User::all();

        foreach ($documentos as $doc) {
            Assinatura::factory()->create([
                'documento_id' => $doc->id,
                'assinado_por' => $usuarios->random()->id,
            ]);
        }
    }
}
