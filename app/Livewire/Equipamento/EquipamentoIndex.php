<?php

namespace App\Livewire\Equipamento;

use App\Models\Equipamento;
use App\Models\Inventario;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class EquipamentoIndex extends Component
{
    use WithPagination;
    public $quantity = 5; 
    public $search = null; 
    public $statusFilter = null;
    public $nome;
    public $id;
    public $idUnidade;


    #[On('dispatchDeletedEquipamento')]
    public function resetTable(){
        $this->resetPage();
    }

    public function dispatchOpenCreateModal(){
        $this->dispatch('dispatchOpenModalCreateEquipamento');
    }
    public function dispatchOpenEditModal($id){
        $this->dispatch('dispatchOpenModalEditEquipamento', $id);
    }
    public function dispatchOpenDeleteModal($id){
        $this->dispatch('dispatchOpenModalDeleteEquipamento', $id);
    }
    public function dispatchOpenShowInfos($id){
        $this->dispatch('dispatchOpenModalShowEquipamentos', $id);
    }

    public function voltarInventarios() {
        redirect()->route('inventario', $this->idUnidade);
    }


    public function mount($idUnidade,$idInventario)
    {
        $this->id = $idInventario;
        $this->idUnidade = $idUnidade;
        $this->nome = Inventario::findOrfail($idInventario)['nome'];
    }
    


 
 
    public function with()
   {

    
        return [
            'headers' => [
                ['index' => 'id', 'label' => 'Id'],
                ['index' => 'codigo_patrimonio', 'label' => 'Codigo'],
                ['index' => 'nomeEquipamento', 'label' => 'Nome'],
                ['index' => 'status', 'label' => 'Status'],
                ['index' => 'categoria', 'label' => 'Categoria', 'responsive' => true],
                ['index' => 'marca', 'label' => 'marca', 'responsive' => true],
                ['index' => 'atualizadoEm', 'label' => 'Atualizado em', 'responsive' => true],
                ['index' => 'actions', 'label' => 'Ações'],
            ],
            'rows' => Equipamento::query()
            ->with(['inventario:id,nome,unidade_id'])
            ->where('inventario_id', $this->id)
            ->when($this->search, function (Builder $query) {
                $search = strtolower($this->search);
                return $query->where(function ($q) use ($search) {
                    $q->whereRaw('LOWER(equipamentos.codigo_patrimonio) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(equipamentos.nome) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(equipamentos.categoria) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(equipamentos.marca) LIKE ?', ["%{$search}%"]);
                });
            })
            ->when($this->statusFilter, function (Builder $query) {
                return $query->where('equipamentos.status', $this->statusFilter);
            })
            ->select([
                'equipamentos.id','equipamentos.nome as nomeEquipamento','codigo_patrimonio', 
                'marca', 'status', 'categoria', 'updated_at as atualizadoEm',
                ])
            ->orderBy('equipamentos.id', 'asc')
            ->paginate($this->quantity)
            ->withQueryString(),
        ];
    }
    public function render()
    {
        return view('livewire.equipamento.equipamento-index', $this->with());
    }
    public function updatedSearch(){$this->resetPage();}

    public function updatedStatusFilter(){$this->resetPage();}

    public function updatedQuantity(){$this->resetPage();}
}
