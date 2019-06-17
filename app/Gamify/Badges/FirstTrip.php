<?php

namespace App\Gamify\Badges;

use QCod\Gamify\BadgeType;

class FirstTrip extends BadgeType
{
    /**
     * Description for badge
     *
     * @var string
     */
    protected $description = 'Crachá referente à primeira viagem do condutor';

    /**
     * Check is user qualifies for badge
     *
     * @param $user
     * @return bool
     */
    public function qualifier($user)
    {
        return $user->getPoints() >= 10;
    }
}
