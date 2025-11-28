<?php

namespace App\Livewire\Unidade;

use App\Enums\UFEnum;
use App\Models\Endereco;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $ufs;
    public $step;
    public $responsaveis = [ ];
    public $ensinos = [ ];
    public $unidade = [
    'id' => null,
    'nome' => '',
    'responsavel' => '',
    'telefone' => '',
    'email' => '',
    'celular' => '',
    'codigo_unidade' => '',
    'ensino_tipo' => '',
    'endereco' => [
        'uf' => '',
        'cidade' => '',
        'bairro' => '',
        'rua' => '',
        'numero' => '',
        'cep' => '',
    ],
];
    
    #[On('dispatchOpenModalCreateUnidade')]
    public function OpenModal(){
        $this->resetValidation();
        $this->reset('unidade');
        $this->step=1;
        $this->modal = true;
    }

    public function updatedUnidadeEnderecoCep($value){
        
        $cepValue = preg_replace('/[^0-9]/', '', $value);
        
        if (strlen($cepValue) === 8) {
            
            $data= Http::get("https://viacep.com.br/ws/{$cepValue}/json/")->json();
            $this->unidade['endereco'] = [
                    'uf' => $data['uf'] ?? '',
                    'bairro' => $data['bairro'] ?? '',
                    'cidade' => $data['localidade'] ?? '',
                    'rua' => $data['logradouro'] ?? '',
                    'numero' => $this->unidade['endereco']['numero'] ?? '',
                    'cep' => $this->unidade['endereco']['cep'] ?? '',
                ];
        }
    }

    public function mount()
    {
        $this->ufs = UFEnum::selectOptions();
        $this->ensinos = Unidade::pluck('ensino_tipo')
        ->unique()->values()->toArray();
        $this->responsaveis = User::with('role:id,nome')
        ->whereHas('role', function($query) {
            $query->where('nome', 'diretor');
        })
        ->select('id as value', 'nome as label') 
        ->get()
        ->toArray();
        return $this->ufs;
    }

    public function createUnidade(){

        $data = $this->validate([
            'unidade.nome'           => 'required|string|min:3',
            'unidade.responsavel'    => 'exists:users,id',
            'unidade.telefone'       => 'nullable|string|unique:unidades,telefone',
            'unidade.email'          => 'required|email|unique:unidades,email',
            'unidade.celular'        => 'nullable|string|unique:unidades,celular',
            'unidade.codigo_unidade' => 'required|string|unique:unidades,codigo_unidade',
            'unidade.ensino_tipo'    => 'required|string',

            'unidade.endereco.uf'      => 'required|string|size:2',
            'unidade.endereco.cidade'  => 'required|string',
            'unidade.endereco.bairro'  => 'required|string',
            'unidade.endereco.rua'     => 'required|string',
            'unidade.endereco.numero'  => 'required',
            'unidade.endereco.cep'     => 'required|string|min:8|max:9',
        ]);
        $endereco = Endereco::create($data['unidade']['endereco']);
        unset($data['unidade']['endereco']);
        Unidade::create([
            ...$data['unidade'],
            'endereco_id' => $endereco['id'],
        ]);
        $this->modal = false;
        $this->reset('unidade');
        $this->dispatch('dispatchCreatedUnidade');
    }

    public function render()
    {
        return view('livewire.unidade.create');
    }
}
