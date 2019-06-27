<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    protected $fillable = ['altura', 'comprimento', 'largura', 'foto', 'nome', 'viagems_id', 'user_id'];

    public function viagems()
    {
        return $this->belongsTo(Viagem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
