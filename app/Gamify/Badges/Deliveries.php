<?php

namespace App\Gamify\Badges;

use QCod\Gamify\BadgeType;

class Deliveries extends BadgeType
{
    /**
     * Description for badge
     *
     * @var string
     */
    protected $description = '';

    /**
     * Check is user qualifies for badge
     *
     * @param $user
     * @return bool
     */
    public function qualifier($user)
    {
        $viagem = Viagem::where('user_id', $user->id)->get();
        // return $user->getPoints() >= 1000;
    }
}
