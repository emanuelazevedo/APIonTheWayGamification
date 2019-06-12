<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    //
    protected $fillable = ['tipoViagem'];

    public function viagems()
    {
        return $this->hasMany(Viagem::class);
    }
}
