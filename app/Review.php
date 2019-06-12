<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = ['nota', 'comentario', 'viagems_id', 'user_id'];

    public function viagem()
    {
        return $this->belongsTo(Viagem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
