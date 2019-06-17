<?php

namespace App\Gamify\Badges;

use QCod\Gamify\BadgeType;

use App\Viagem;

class Distances extends BadgeType
{
    /**
     * Description for badge
     *
     * @var string
     */
    protected $description = 'Crachá de distância percorrida como entregador';

    protected $level;
    /**
     * Check is user qualifies for badge
     *
     * @param $user
     * @return bool
     */
    public function qualifier($user)
    {
        $viagem = Viagem::where('user_id', $user->id)->get();
        //return $user->getPoints() >= 1000;
    }
}
