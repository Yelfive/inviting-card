<?php

/**
 * @author Felix Huang <yelfivehuang@gamil.com>
 */

namespace fk\helpers;

use fk;

class Css
{
    protected static $count = 0;
    protected static $keyframes = [];
    protected static $styles = [];

    public static function keyframes($name, $data)
    {
        self::$count++;
        self::$keyframes[] = static::_keyframes($name, $data);
    }

    public static function style($selector, $data)
    {
        self::$count++;
        return self::$styles[] = static::_style($selector, $data);
    }

    public static function register()
    {
        if (DEBUG) {
            echo "\n";
        }
        $data = array_merge(self::$keyframes, self::$styles);
        foreach ($data as $style) {
            echo $style;
        }
        if (DEBUG) {
            echo "\n";
        }
    }

    protected static function is_webkit($property = null)
    {
        /**
         * $webkit = fk::$app->request->isAndroid;
         * if only set webkit on android, some iOS will function badly
         */
        $webkit = true;
        if ($property !== null) {
            $webkit = $webkit && (in_array($property, ['transform', 'transition']) || strpos($property, 'animation') !== false);
        }
        return $webkit;
    }

    protected static function webkit($property, $value)
    {
        $style = '';
        $style .= static::tab();
        $pending = DEBUG ? "\n" : '';
        $style .= "$property: $value;$pending";
        if (static::is_webkit($property)) {
            $style .= static::tab();
            $style .= "-webkit-$property: $value;$pending";
        }
        return $style;
    }

    protected static function tab($num = 1)
    {
        return DEBUG ? str_repeat(' ', 4 * $num) : '';
    }

    private static function _keyframes($name, $data)
    {
        $style = '';
        $pending = DEBUG ? "\n" : '';
        $frames = [''];
        if (self::is_webkit()) {
            $frames = ['-webkit-'];
        }
        foreach ($frames as $frame) {
            $style .= "@{$frame}keyframes $name {{$pending}";
            foreach ($data as $progress => $properties) {
                $style .= static::tab(1);
                $style .= "$progress {{$pending}";
                foreach ($properties as $property => $value) {
                    $style .= static::tab(2);
                    $style .= $frame == '-webkit-' && static::is_webkit($property) ? '-webkit-' : '';
                    $style .= "$property: $value;$pending";
                }
                $style .= static::tab(1);
                $style .= "}$pending";
            }
            $style .= "}$pending";
        }

        return $style;
    }

    private static function _style($selector, $data)
    {
        $pending = DEBUG ? "\n" : '';
        $style = "$selector {{$pending}";
        foreach ($data as $property => $value) {
            $style .= static::webkit($property, $value);
        }
        $style .= "}$pending";
        return $style;
    }

}