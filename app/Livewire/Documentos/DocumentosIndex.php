<?php

namespace App\Livewire\Documentos;

use App\Models\Documento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class DocumentosIndex extends Component
{
    public $tab = "Assinar";
    public $selectedDocument = "";
    public $path = "";
    
    public $documentos = [
        [
            "id" => '',
            "nome" => '',
            "tipo" => '',
            "status" => '',
            "path" => ''
        ]
    ];
    public $userId;
    
    public function mount() {
        $this->userId = Auth::user()->id;
        return;
    }

    public function updatedTab($value){
        $this->selectedDocument = "";
        $this->path = null;
    }
    public function updatedSelectedDocument($value){ 
    
    $this->path = collect($this->documentos)->firstWhere('id', $this->selectedDocument)['path'];
    }

    public function formatarArray($docs){
        $userId = $this->userId;
        return $docs->map(function ($doc) use ($userId) {
            $assinaturaDoUsuario = $doc->assinaturas->firstWhere('assinado_por', $userId);
            $usuarioAssinou = (bool) $assinaturaDoUsuario?->assinado;
            $todosAssinaram = $doc->assinaturas->every->assinado;

            $status = match (true) {
                !$usuarioAssinou => "assinar",
                !$todosAssinaram => "em espera",
                default => "assinado"
            };

            
            return [
                "id" => $doc->id,
                "nome" => $doc->nome,
                "tipo" => $doc->tipo->nome,
                "status" => $status,
                "path" => $doc->documento_path
            ];
        })->toArray();
    }
    
    
    public function with() {
        $userId = $this->userId;
        $documentos = Documento::with(['assinaturas', 'tipo'])
            ->whereHas('assinaturas', function ($q) use ($userId) {
                $q->where('assinado_por', $userId);
            })
            ->get();
        $this->documentos = $this->formatarArray($documentos);
        return $this->documentos;
    }

    public function render()
    {
        
        return view('livewire.documentos.documentos-index', $this->with());
    }
}
