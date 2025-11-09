<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ferramenta extends Model
{
    protected $fillable = ['nome', 'ativo'];

    public function contas()
    {
        return $this->hasMany(Conta::class);
    }
}
