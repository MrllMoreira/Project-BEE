<?php

namespace App\Livewire\Inventario;

use App\Models\Inventario;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal= false;
    public $nome;
    public $status;
    #[On('dispatchOpenModalEditInventario')]
    public function openModal($id) {
        $inventario = Inventario::select("nome", "status")
        ->where("id", '=', $id)
        ->first();

        $this->modal = true;
        $this->nome = $inventario['nome'];
        $this->status = $inventario['status'];;
        
    }
    public function render()
    {
        return view('livewire.inventario.edit');
    }
}
