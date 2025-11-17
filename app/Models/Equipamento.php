<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'equipamentos';

    protected $fillable = [
        'codigo_patrimonio',
        'categoria_id',
        'marca_id',
        'status_id',
        'inventario_id',
        'descricao',
    ];
}
