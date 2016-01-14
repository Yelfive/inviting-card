<?php

echo "\n";
echo style('#circle-flowers > div', ['transform' => 'scale(0.5)']);
echo style('#circle-flowers > div', [
    'width' => '100px',
    'height' => '100px',
    'position' => 'absolute',
    'background-repeat' => 'no-repeat',
    'transform' => 'scale(0.7)',
    'opacity' => '0',
    'animation-fill-mode' => 'forwards !important',
]);

for ($i = 1; $i <= 22; $i++) {
    $bgLeft = Background::left($i);
    $bgTop = Background::top($i);
    $delay = $i * 0.1;
    echo style("#circle-flowers > div:nth-child($i)", [
        'background-image' => 'url(../images/flowers.png)',
        'background-position' => "-{$bgLeft}px -{$bgTop}px",
    ]);
    echo style("#circle-flowers.bloom > div:nth-child($i)", [
        'animation' => "bloom 0.5s ease-in-out {$delay}s",
    ]);
}

echo keyframes('bloom', [
    'from' => ['transform' => 'scale(0) translateZ(0)', 'opacity' => '1'],
    'to' => ['transform' => "scale(0.5) translateZ(0)", 'opacity' => '1'],
]);

/* bubble */

echo style('#menu #bubble canvas', [
    'animation-fill-mode' => 'forwards !important',
    'transform' => 'scale(1.5)',
    'opacity' => 0,
]);

echo keyframes('bubbleIn', [
    '0%' => ['transform' => 'scale(0) translateZ(0)', 'opacity' => 1],
//    '90%' => ['transform' => 'scale(1.2) translateZ(0)', 'opacity' => 1],
    '100%' => ['transform' => 'scale(1) translateZ(0)', 'opacity' => 1],
]);

echo keyframes('fadeIn', ['from' => ['opacity' => 0], 'to' => ['opacity' => 1]]);

$max = 10;
$duration = 0.25;
$operand = 1;
for ($i = 1; $i <= $max; $i++) {
    $delay = ($max - $i) * $duration * 0.8;
    if ($i < 5) {
        $i % 2 === 0 && $operand *= -1;
        $degree = $operand * rand(5, 15);
        echo style("#items > div:nth-child($i)", ['transform' => "rotateZ({$degree}deg) translateZ(0)"]);
        echo style("#menu.kiss #items > div:nth-child($i)", [
            'animation' => "fadeIn 0.5s ease-in {$delay}s",
            'animation-fill-mode' => 'forwards',
        ]);
        continue;
    }
    $pos = $i / $max * 100;
    $left = $pos;
    $top = $pos;
    echo style("#menu #bubble canvas:nth-child($i)", ['left' => "$left%", 'top' => "$top%"]);
    echo style("#menu.kiss #bubble canvas:nth-child($i)", [
        'animation' => "bubbleIn {$duration}s ease-out {$delay}s",
    ]);
}

/* bubble END */

for ($i = 1; $i <= 17; $i++) {
    $degree = 0.5 * $i - 2;
    echo <<<STYLE

.wrapper .album li:nth-child($i) {
    -webkit-transform: rotateZ({$degree}deg);
    transform: rotateZ({$degree}deg);
}
STYLE;
}
