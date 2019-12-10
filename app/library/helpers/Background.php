<?php

/**
 * @author Felix Huang <yelfivehuang@gamil.com>
 */

namespace fk\helpers;

class Background
{
    public static function left($i)
    {
        return 100 * (($i % 6) - 1);
    }

    public static function top($i)
    {
        if ($i == 17) {
            return 172;
        }
        return 96 * floor($i / 6); // 172
    }

    public static function scale($i)
    {
        return $i == 3 ? 2 : round(rand(3, 7) / 10, 2);
    }

}