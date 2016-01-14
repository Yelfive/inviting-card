<?php

echo "\n";
echo style('#circle-flowers > div', ['transform' => 'scale(0.5)']);
echo style('#circle-flowers > div', [
    'width' => '100px',
    'height' => '100px',
    'position' => 'absolute',
    'background-repeat' => 'no-repeat',
    'transform' => 'scale(0.5)',
    'opacity' => '0',
    'animation-fill-mode' => 'forwards !important',
]);

for ($i = 1; $i <= 22; $i++) {
    $left = 315;
    $top = 0;
    $delay = $i * 0.1;
    echo style("#circle-flowers > div:nth-child($i)", [
        'background-image' => 'url(../images/flowers.png)',
        'background-position' => "-{$left}px -{$top}px",
    ]);
    echo style("#circle-flowers.bloom > div:nth-child($i)", [
        'animation' => "bloom 0.5s ease-in-out {$delay}s",
    ]);
    echo keyframes('bloom', [
        'from' => ['transform' => 'scale(0) translateZ(0)', 'opacity' => '1'],
        'to' => ['transform' => 'scale(0.5) translateZ(0)', 'opacity' => '1'],
    ]);
}


for ($i = 1; $i <= 17; $i++) {
    $degree = 0.5 * $i - 2;
    echo <<<STYLE

.wrapper .album li:nth-child($i) {
    -webkit-transform: rotateZ({$degree}deg);
    transform: rotateZ({$degree}deg);
}
STYLE;
}

$max = 10;
$duration = 0.25;
for ($i = 1, $j = 1; $i <= $max; $i++) {
    $t = ($max - $i) * $duration + 0.5;
    if ($i < 5) {
        if ($j > 4) {
            break;
        }
        echo <<<STYLE
#menu.kiss #items > div:nth-child($j) {
    animation: fadeIn 0.5s ease-out {$t}s;
    -webkit-animation: fadeIn 1s ease-out {$t}s;
    animation-fill-mode: both;
}

STYLE;
        $j++;
    } else {
        $pos = $i / $max * 100;
        $left = $pos;
        $top = $pos;
        echo <<<STYLE
#menu #bubble canvas:nth-child($i) {
    left: $left%;
    top: $top%;
}
#menu.kiss #bubble canvas:nth-child($i) {
    animation: bubbleIn {$duration}s ease-out {$t}s;
    -webkit-animation: bubbleIn {$duration}s ease-out {$t}s;
}

STYLE;
    }
}