<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeTipo extends Model
{

    use HasFactory;

    
    protected $table = 'unidades_tipo';

    protected $fillable = [
        'nome',
        'descricao',
    ];

}
