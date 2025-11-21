<?php

namespace App\Livewire\Unidade;

use App\Enums\UFEnum;
use App\Models\Endereco;
use Illuminate\Support\Facades\Http;
use App\Models\Unidade;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal= false;
    public $ufs;
    public $responsaveis = [ ];

    public $unidade = [
    'id' => null,
    'nome' => '',
    'responsavel' => '',
    'telefone' => '',
    'email' => '',
    'celular' => '',
    'codigo_unidade' => '',
    'ensino_tipo' => null,
    'endereco' => [
        'uf' => '',
        'regiao' => '',
        'cidade' => '',
        'bairro' => '',
        'rua' => '',
        'numero' => '',
        'cep' => '',
    ],
];
    #[On('dispatchOpenModalEditUnidade')]
    public function openModal($id) {
        $this->resetValidation();

        $this->unidade = Unidade::with('endereco')
        ->findOrFail($id)->toArray();
        
        $this->modal = true;
       
        
    }
    public function mount(){
        $this->ufs = UFEnum::selectOptions();

        $this->responsaveis = User::with('role:id,nome')
        ->whereHas('role', function($query) {
            $query->where('nome', 'diretor');
        })
        ->select('id as value', 'nome as label') 
        ->get()
        ->toArray();

        return $this->ufs;
    }

    public function updatedUnidadeEnderecosCep($value)
    {
       
        $cepValue = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cepValue) === 8) {
            $data= Http::get("https://viacep.com.br/ws/{$cepValue}/json/")->json();
            
            $endereco = [
                    'rua' => $data['logradouro'] ?? '',
                    'bairro' => $data['bairro'] ?? '',
                    'cidade' => $data['localidade'] ?? '',
                    'uf' => $data['uf'] ?? '',
                ];
            $this->unidade['enderecos'] = array_merge(
                $this->unidade['enderecos'],
                $endereco
            );
        }
    }
    public function editUnidade()  {

        $data = $this->validate([
            'unidade.nome' => 'required|string|min:3',
            'unidade.responsavel' => 'required|exists:users,id',
            'unidade.ensino_tipo' => 'required|string',

            'unidade.telefone' => 'nullable|string|unique:unidades,telefone,'.
                $this->unidade['id'],
            'unidade.email' => 'required|email|unique:unidades,email,' . 
                $this->unidade['id'],
            'unidade.celular' => 'nullable|string|unique:unidades,celular,' . 
                $this->unidade['id'],
            'unidade.codigo_unidade' => 'required|string|unique:unidades,codigo_unidade,' .
                $this->unidade['id'],

            'unidade.endereco.uf'=> 'required|string|size:2',
            'unidade.endereco.cidade' => 'required|string',
            'unidade.endereco.bairro' => 'required|string',
            'unidade.endereco.rua' => 'required|string',
            'unidade.endereco.numero' => 'required',
            'unidade.endereco.cep' => 'required|string|min:8|max:9',
        ]);

        Endereco::find($this->unidade['endereco']['id'])
        ->update($data['unidade']['endereco']);

        unset($data['unidade']['endereco']);
        Unidade::find($this->unidade['id'])->update($data['unidade']);

        $this->modal = false;
        $this->reset('unidade');
        $this->dispatch('dispatchEditUnidade');
    }
    
    public function render()
    {
        return view('livewire.unidade.edit');
    }
}
