<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
     protected $fillable = [
        'user_id',
        'conta_id',
        'inicio',
        'fim',
        'status',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }
}
