<?php

class Background
{
    public static function left($i)
    {
        return 100 * (($i % 6) - 1);
    }

    public static function top($i)
    {
        return 96 * floor($i / 6);
    }

    public static function scale($i)
    {
        return $i == 3 ? 2 : round(rand(3, 7) / 10, 2);
    }

}

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
        $data = array_merge(self::$keyframes, self::$styles);
        foreach ($data as $style) {
            echo $style;
        }
        echo "\n";
    }

    protected static function is_webkit($property)
    {
        return in_array($property, ['transform']) || strpos($property, 'animation') !== false;
    }

    protected static function webkit($property, $value)
    {
        $style = '';
        $style .= static::tab();
        $style .= "$property: $value;\n";
        if (static::is_webkit($property)) {
            $style .= static::tab();
            $style .= "-webkit-$property: $value;\n";
        }
        return $style;
    }

    protected static function tab($num = 1)
    {
        return str_repeat(' ', 4 * $num);
    }

    private static function _keyframes($name, $data)
    {
        $style = '';
        foreach (['', '-webkit-'] as $frame) {
            $style .= "@{$frame}keyframes $name {\n";
            foreach ($data as $progress => $properties) {
                $style .= static::tab(1);
                $style .= "$progress {\n";
                foreach ($properties as $property => $value) {
                    $style .= static::tab(2);
                    $style .= $frame == '-webkit-' && static::is_webkit($property) ? '-webkit-' : '';
                    $style .= "$property: $value;\n";
                }
                $style .= static::tab(1);
                $style .= "}\n";
            }
            $style .= "}\n";
        }

        return $style;
    }

    private static function _style($selector, $data)
    {
        $style = "$selector {\n";
        foreach ($data as $property => $value) {
            $style .= static::webkit($property, $value);
        }
        $style .= "}\n";
        return $style;
    }

}