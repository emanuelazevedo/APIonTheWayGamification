<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    protected $fillable = ['estado'];

    public function viagems()
    {
        return $this->hasMany(Viagem::class);
    }
    
}
