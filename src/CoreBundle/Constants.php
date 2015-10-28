<?php

namespace CoreBundle;

/**
 * Class Constants.
 */
final class Constants
{
    const BATTLE_TYPE_5_VS_5 = '5_VS_5';

    const FIGHTER_PLAYER = 'PLAYER';
    const FIGHTER_NPC = 'NPC';

    public static function FIGHTERS()
    {
        return [
            self::FIGHTER_PLAYER,
            self::FIGHTER_NPC,
        ];
    }
}
