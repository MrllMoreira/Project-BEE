<?php

namespace App\Livewire\Inventario;

use App\Models\Inventario;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $modal = false;
    public $inventario = [
        'status' => null,
        'nome' => null
    ];
    #[On('dispatchOpenModalShowInventario')]
    public function OpenModal($id){
        $this->inventario = Inventario::query()
                ->join('inventario_status', 'inventario.status', '=', 'inventario_status.id')
                ->select('inventario.nome', 'inventario_status.nome as status')
                ->where('inventario.id', '=', $id)->first()->toArray();
        $this->modal = true;
   
    }
    public function render()
    {
        return view('livewire.inventario.show');
    }
}
