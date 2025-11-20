<?php

namespace App\Livewire\Inventario;

use App\Models\Inventario;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal= false;
    public $inventario = [
        'nome' => '',
        'status' =>'',
        'descricao' =>'',
    ];
    #[On('dispatchOpenModalEditInventario')]
    public function openModal($id) {
        $this->inventario = Inventario::select("nome", "status", "descricao")
        ->where("id", $id)
        ->first()->toArray();

        $this->modal = true;
    }
    public function editInventario() {
        dump($this->inventario);
    }
    public function render()
    {
        return view('livewire.inventario.edit');
    }
}
