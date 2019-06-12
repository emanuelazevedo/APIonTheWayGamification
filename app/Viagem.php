<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viagem extends Model
{
    //
    protected $fillable = ['origem', 'destino', 'data', 'horaInicio', 'horaFim', 'estado_id', 'user_id', 'produto_id', 'tipo_id', 'preco'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
    
}
