<?php
function is_webkit($property) {
    return in_array($property, ['transform']) || strpos($property, 'animation') !== false;
}

function webkit ($property, $value) {
    $style = '';
    $style .= tab();
    $style .= "$property: $value;\n";
    if (is_webkit($property)) {
        $style .= tab();
        $style .= "-webkit-$property: $value;\n";
    }
    return $style;
}
function tab($num = 1) {
    return str_repeat(' ', 4 * $num);
}

function keyframes ($name, $data) {
    $style = '';
    foreach (['', '-webkit-'] as $frame) {
        $style .= "@{$frame}keyframes $name {\n";
        foreach ($data as $progress => $properties) {
            $style .= tab(1);
            $style .= "$progress {\n";
            foreach ($properties as $property => $value) {
                $style .= tab(2);
                $style .= $frame == '-webkit-' && is_webkit($property) ? '-webkit-' : '';
                $style .= "$property: $value;\n";
            }
            $style .= tab(1);
            $style .= "}\n";
        }
        $style .= "}\n";
    }

    return $style;
}

function style($selector, $data) {
    $style = "$selector {\n";
    foreach ($data as $property => $value) {
        $style .= webkit($property, $value);
    }
    $style .= "}\n";
    return $style;
}

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