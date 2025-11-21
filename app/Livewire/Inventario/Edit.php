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
        $this->resetValidation();
        $this->inventario = Inventario::select("nome", "status", "descricao", 'id')
        ->where("id", $id)
        ->first()->toArray();

        $this->modal = true;
    }
    public function editInventario() {

        $data = $this->validate([
            'inventario.nome' => 'required|string|min:3|unique:inventario,nome,'. $this->inventario['id'],
            'inventario.status' => 'required|string',
            'inventario.descricao' => 'nullable|string|max:200',
        ]);

        Inventario::find($this->inventario['id'])->update([
            ...$data['inventario'],
        ]);

        $this->modal = false;
        $this->reset('inventario');
        $this->dispatch('dispatchEditInventario');
    }
    public function render()
    {
        return view('livewire.inventario.edit');
    }
}
