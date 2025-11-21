<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventoTipo extends Model
{
    use HasFactory;

    protected $table = 'evento_tipos';

    protected $fillable = [
        'nome',
        'descricao',
    ];
}
