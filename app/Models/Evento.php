<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'status',
        'dados',
        'evento_tipo_id',
        'criado_por',
    ];

    protected $casts = [
        'dados' => 'array',
    ];

    public function tipo()
    {
        return $this->belongsTo(EventoTipo::class, 'evento_tipo_id');
    }

    public function criadoPor()
    {
        return $this->belongsTo(User::class, 'criado_por');
    }
}
