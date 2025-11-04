<?php

namespace App\Livewire\Documentos;

use Livewire\Component;

class DocumentosIndex extends Component
{
    public $tab = "Assinar";
    public $selectedDocument = "";
    public $documentos = [
            [
                "id" => 1,
                "nome" => "Contrato de Empréstimo Pessoal",
                "tipo" => "Empréstimo",
                "status" => "assinar"
            ],
            [
                "id" => 2,
                "nome" => "Termo de Adesão - Cartão de Crédito", 
                "tipo" => "Cartão",
                "status" => "assinado"
            ],
            [
                "id" => 3,
                "nome" => "Contrato de Financiamento Veicular",
                "tipo" => "Financiamento",
                "status" => "em espera"
            ],
            [
                "id" => 4,
                "nome" => "Contrato de Abertura de Conta",
                "tipo" => "Conta Bancária",
                "status" => "assinar"
            ],
            [
                "id" => 5,
                "nome" => "Termo de Portabilidade de Crédito",
                "tipo" => "Portabilidade",
                "status" => "em espera"
            ]
        ];
    
    public function updatedTab($value){
        $this->selectedDocument = "";
    }

    public function render()
    {
        return view('livewire.documentos.documentos-index');
    }
}
