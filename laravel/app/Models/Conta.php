<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
   protected $fillable = [
        'ferramenta_id', 'usuario', 'senha', 'status', 'ultima_atualizacao'
    ];

    public function ferramenta()
    {
        return $this->belongsTo(Ferramenta::class);
    }
}
