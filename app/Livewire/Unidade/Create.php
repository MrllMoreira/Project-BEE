<?php

namespace App\Livewire\Unidade;

use App\Enums\UFEnum;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $ufs;
    public $endereco;
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
        'cidade' => '',
        'bairro' => '',
        'rua' => '',
        'numero' => '',
        'cep' => '',
    ],
];
    public $step;
    #[On('dispatchOpenModalCreateUnidade')]
    public function OpenModal(){
        $this->step=1;
        $this->modal = true;
    }

    public function updatedUnidadeEnderecoCep($value)
    {
        
        $cepValue = preg_replace('/[^0-9]/', '', $value);
        
        if (strlen($cepValue) === 8) {
            
            $data= Http::get("https://viacep.com.br/ws/{$cepValue}/json/")->json();
            $this->unidade['endereco'] = [
                    'uf' => $data['uf'] ?? '',
                    'bairro' => $data['bairro'] ?? '',
                    'cidade' => $data['localidade'] ?? '',
                    'rua' => $data['logradouro'] ?? '',
                    'numero' => $this->unidade['endereco']['numero'] ?? '',
                    'cep' => $data['cep'] ?? '',
                ];
        }
    }

    public function mount()
    {
        $this->ufs = UFEnum::selectOptions();
        return $this->ufs;
    }

    public function createUnidade(){
        dump($this->unidade);
    
    }

    public function render()
    {
        return view('livewire.unidade.create');
    }
}
