<?php

namespace App\Livewire\Equipamento;

use App\Models\Equipamento;
use App\Models\Role;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $modal = false;
    public $equipamento = [
        'nome' => '',
        "codigo_patrimonio" => '',
        "marca" => '',
        "status" => '',
        "categoria" => '',
        "atualizadoEm" => '',
        'descricao' => '',
    ];
    #[On('dispatchOpenModalShowEquipamentos')]
    public function OpenModal($id){

        $this->equipamento = Equipamento::query()
        ->where('id', $id)
        ->select([
            'id','nome', 'codigo_patrimonio', 'descricao','marca', 
            'status','categoria', 'updated_at as atualizadoEm'
        ])
        ->first()
        ->toArray();
        $this->modal = true;
    }
    public function render()
    {
        return view('livewire.equipamento.show');
    }
}
