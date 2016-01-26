<?php

echo "\n";
Css::style('#stage-in canvas', ['animation' => 'heartbeats 1s ease infinite']);

Css::style('#circle-flowers > div', ['transform' => 'scale(0.5)']);
Css::style('#circle-flowers > div', [
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
    $delay = $i * 0.3;
    Css::style("#circle-flowers > div:nth-child($i)", [
        'background-image' => "url($imgHost/flowers.png)",
        'background-position' => "-{$bgLeft}px -{$bgTop}px",
    ]);
    Css::style("#circle-flowers.bloom > div:nth-child($i)", [
        'animation' => "bloom 1s ease-in-out {$delay}s",
    ]);
}

Css::keyframes('bloom', [
    'from' => ['transform' => 'scale(0) translateZ(0)', 'opacity' => 1],
    'to' => ['transform' => 'scale(0.5) translateZ(0)', 'opacity' => 1],
]);

/* bubble */

Css::style('#menu #bubble canvas', [
    'animation-fill-mode' => 'forwards !important',
    'transform' => 'scale(0)',
    'opacity' => 0,
]);

Css::style('#menu.kiss #bubble canvas', [
    'transform' => 'scale(1.5)',
]);

Css::keyframes('bubbleIn', [
    '0%' => ['transform' => 'scale(2)', 'opacity' => 0],
    '1%' => ['transform' => 'scale(0)', 'opacity' => 1],
    '100%' => ['transform' => 'scale(1)', 'opacity' => 1],
]);

Css::keyframes('fadeIn', ['from' => ['opacity' => 0, 'transform' => 'translate3d(0, 0, 0)'], 'to' => ['opacity' => 1]]);

$max = 10;
$duration = 0.25;
$operand = 1;
for ($i = 1; $i <= $max; $i++) {
    $delay = ($max - $i) * $duration * 0.8;
    if ($i <= 5) {
        $i % 2 === 0 && $operand *= -1;
        $degree = $operand * rand(5, 15);
        Css::style("#items > div:nth-child($i)", ['transform' => "rotateZ({$degree}deg)"]);
        Css::style("#menu.kiss #items > div:nth-child($i)", [
            'animation' => "fadeIn 0.5s ease-in {$delay}s",
            'animation-fill-mode' => 'forwards',
        ]);
        continue;
    }
    $pos = $i / $max * 100;
    $left = $pos;
    $top = $pos;
    Css::style("#menu #bubble canvas:nth-child($i)", ['left' => "$left%", 'top' => "$top%"]);
    Css::style("#menu.kiss #bubble canvas:nth-child($i)", [
        'animation' => "bubbleIn {$duration}s ease-out {$delay}s",
    ]);
}

/* bubble END */
if (fk::$app->request->terminal == 'pc') {
    Css::keyframes('photoIn', ['from' => ['transform' => 'scale(0.01)']]);
    for ($i = 1; $i <= 17; $i++) {
        $degree = 0.5 * $i - 2;
        $delay = round(($i - 1) / 18, 1);
        Css::style(".wrapper .album li:nth-child($i)", ['transform' => "rotateZ({$degree}deg) translateZ(0)"]);
        Css::style("#album-ul.photo-in li:nth-child($i)", ['animation' => "photoIn 0.5s ease-in-out {$delay}s"]);
    }
}

Css::style('.wrapper .flip-90-0', [
    'transform' => 'rotateX(0deg)',
    'animation' => 'flip-90-0 0.6s linear',
]);
Css::style('.wrapper .flip-0-90', [
    'transform' => 'rotateY(90deg)',
    'animation' => 'flip-0-90 0.6s linear',
]);

Css::keyframes('flip-0-90', [
    '0%' => ['transform' => 'rotateY(0deg)'],
    '100%' => ['transform' => 'rotateY(90deg)'],
]);
Css::keyframes('flip-90-0', [
    '0%' => ['transform' => 'rotateY(-90deg)'],
    '100%' => ['transform' => 'rotateY(0deg)'],
]);
Css::style('.rotateY-90', ['transform' => 'rotateY(-90deg)']);
Css::keyframes('touchIn', [
    '0%' => ['transform' => 'scale(1.5)', 'opacity' => 0], // TODO: touch in animation
    '100%' => ['transform' => 'scale(1)', 'opacity' => 1],
]);

Css::style('transition', ['transition' => 'transform 1s']);

Css::keyframes('zoomIn', [
    'to' => ['transform' => 'scale(1.3)'],
]);
Css::keyframes('heartbeats', [
    '0%, 100%' => ['transform' => 'scale(0.8)'],
    '50%' => ['transform' => 'scale(1)'],
]);
Css::style('#heartbeats', [
    'position' => 'absolute',
    'left' => 0,
    'top' => 0,
    'text-align' => 'center',
    'height' => '100%',
    'width' => '100%',
    'background-color' => 'rgba(255, 255, 255, 0.3)',
    'z-index' => 1,
    'display' => 'none',
]);

Css::style('#heartbeats.beats', ['display' => 'block']);
Css::style('#heartbeats.beats > canvas', [
    'animation' => 'heartbeats 1s ease-in-out infinite',
    'animation-fill-mode' => 'both'
]);
Css::style('#heartbeats > canvas:nth-child(1)', [
]);
Css::style('#heartbeats > canvas:nth-child(2)', [
    'margin-left' => '-20px',
    'width' => '50px',
]);
Css::style('#heartbeats > canvas:nth-child(3)', [
    'margin-left' => '-10px',
    'width' => '80px',
]);
Css::style('#heartbeats > canvas', [
    'margin-top' => '50%'
]);
/* album out */

/* Music */
Css::keyframes('rotate', [
    'from' => ['transform' => 'rotateZ(0deg)'],
    'to' => ['transform' => 'rotateZ(360deg)'],
]);
Css::style('#music', ['animation' => 'rotate 10s linear infinite']);
Css::style('#music.paused', ['animation-play-state' => 'paused']);

/* Video */
Css::keyframes('videoPlay', [
    'from' => ['opacity' => 1, 'transform' => 'scale(1)'],
    'to' => ['opacity' => 0, 'transform' => 'scale(0)'],
]);
Css::style('.video.play .start', ['animation' => 'videoPlay 1s ease', 'animation-fill-mode' => 'both']);
Css::style('.scale-0', ['transform' => 'scale(0)']);


Css::register();