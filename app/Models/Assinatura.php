<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    use HasFactory;
    protected $fillable = [
        'assinado_em',
        'assinado',
        'assinado_por',
        'documento_id',
    ];

    protected $casts = [
        'assinado_em' => 'datetime',
        'assinado' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'assinado_por');
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
}
