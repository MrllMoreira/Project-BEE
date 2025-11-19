<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{

    use HasFactory;

    
    protected $table = 'unidades';

    protected $fillable =
    [
    'nome',
    'codigo_unidade',
    'telefone',
    'celular',
    'email',
    'unidade_tipo_id',
    'endereco_id',
    'created_by',
    'updated_by',
    'responsavel'
    ];


    public function unidade_tipo()
    {
        return $this->belongsTo(UnidadeTipo::class);
    }

    public function enderecos()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id', 'id');
    }
}
