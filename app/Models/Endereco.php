<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Endereco extends Model
{

    use HasFactory;


    protected $table = 'enderecos';

    protected $fillable = [
        'uf',
        'cidade',
        'bairro',
        'rua',
        'numero',
        'cep',
    ];
    
    public function unidade()
    {
        return $this->hasOne(Unidade::class);
    }
}
