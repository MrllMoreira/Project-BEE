<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'documento_path',
        'documento_tipo_id',
        'evento_id',
    ];

    public function assinaturas()
    {
        return $this->hasMany(Assinatura::class, 'documento_id');
    }
    
    public function tipo()
    {
        return $this->belongsTo(DocumentoTipo::class, 'documento_tipo_id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
}
