<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $connection = 'mysql2';
    use HasFactory;

    protected $fillable = [
        'quantidade',
        'id_tipo',
        'dataQuantidade'
    ];

    public function tipo(){
        return $this->belongsTo(Tipo::class,'id_tipo');
    }
}
