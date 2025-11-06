<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioStatus extends Model
{
    protected $table = 'inventario_status';

    protected $fillable = [
        'nome',
        'descricao',
        'status',
        'created_by',
        'updated_by',
    ];
}
