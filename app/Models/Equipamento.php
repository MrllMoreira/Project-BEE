<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;
    protected $table = 'equipamentos';

    protected $fillable = [
        'codigo_patrimonio',
        'categoria_id',
        'marca_id',
        'status_id',
        'inventario_id',
        'descricao',
    ];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'inventario_id');
    }
}
