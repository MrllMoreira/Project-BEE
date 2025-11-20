<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';

    protected $fillable = [
        'nome',
        'unidade_id',
        'descricao',
        'status',
        'created_by',
        'updated_by',
    ];

}
