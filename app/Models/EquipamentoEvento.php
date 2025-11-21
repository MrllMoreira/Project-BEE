<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipamentoEvento extends Model
{
    use HasFactory;

    protected $table = 'equipamento_eventos';

    protected $fillable = [
        'evento_id',
        'equipamento_id',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}
