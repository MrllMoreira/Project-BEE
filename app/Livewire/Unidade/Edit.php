<?php

namespace App\Livewire\Unidade;

use App\Enums\UFEnum;
use Illuminate\Support\Facades\Http;
use App\Models\Unidade;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal= false;
    public $ufs;
    public $responsaveis = [

    ];

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
        $this->reset('unidade');
        $this->unidade = Unidade::with('endereco')
        ->findOrFail($id)
        ->toArray();
        
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
        dump($this->unidade);
    }
    
    public function render()
    {
        return view('livewire.unidade.edit');
    }
}
