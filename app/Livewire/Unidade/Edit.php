<?php

namespace App\Livewire\Unidade;

use Illuminate\Support\Facades\Http;
use App\Models\Unidade;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal= false;
    public $ufs;

    public $unidade = [
    'id' => null,
    'nome' => '',
    'responsavel' => '',
    'telefone' => '',
    'email' => '',
    'celular' => '',
    'codigo_unidade' => '',
    'unidade_tipo_id' => null,
    'enderecos' => [
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
       
        $this->unidade = Unidade::with('enderecos')
        ->findOrFail($id)
        ->toArray();
        
        
        
        $this->modal = true;
       
        
    }
    public function mount(){
        $this->ufs = collect(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'])
        ->map(fn($uf)=>['label'=>$uf,'value'=>$uf])
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
