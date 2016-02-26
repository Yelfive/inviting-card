<?php

/**
 * @var \fk\web\Application $this
 */
use fk\helpers\Background;
use fk\helpers\Css;

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
Css::keyframes('bubbleIn', ['0%' => ['transform' => 'scale(0)', 'opacity' => 0], '100%' => ['transform' => 'scale(1)', 'opacity' => 1]]);

Css::keyframes('fadeIn', ['from' => ['opacity' => 0, 'transform' => 'translate3d(0, 0, 0)'], 'to' => ['opacity' => 1]]);
Css::keyframes('fadeOut', ['to' => ['opacity' => 0, 'transform' => 'translate3d(0, 0, 0)'], 'from' => ['opacity' => 1]]);

Css::style('.fade-in', ['animation' => 'fadeIn 1s ease-in-out', 'animation-fill-mode' => 'forwards']);
Css::style('.fade-out', ['animation' => 'fadeOut 0.5s ease-in-out', 'animation-fill-mode' => 'forwards']);

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
    Css::style("#menu.kiss #bubble canvas:nth-child($i)", ['animation' => "bubbleIn {$duration}s ease-out {$delay}s"]);
}

Css::style('#menu #bubble canvas', [
    'animation-fill-mode' => 'forwards !important',
    'display' => 'none',
    'opacity' => 0
]);

Css::style('#menu.kiss #bubble canvas', ['display' => 'block']);
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

Css::style('.rotateY-90', ['transform' => 'rotateY(-90deg)', 'opacity' => 0]);

Css::keyframes('flip-0-90', [
    '0%' => ['transform' => 'rotateY(0deg)'],
    '100%' => ['transform' => 'rotateY(90deg)'],
]);
Css::keyframes('flip-0-m90', [
    '0%' => ['transform' => 'rotateY(0deg)'],
    '100%' => ['transform' => 'rotateY(-90deg)'],
]);
Css::keyframes('flip-m90-0', [
    '0%' => ['transform' => 'rotateY(-90deg)'],
    '100%' => ['transform' => 'rotateY(0deg)'],
]);
Css::keyframes('flip-90-0', [
    '0%' => ['transform' => 'rotateY(90deg)'],
    '100%' => ['transform' => 'rotateY(0deg)'],
]);
Css::keyframes('flip-m90-0', [ // minus 90 degree
    '0%' => ['transform' => 'rotateY(-90deg)'],
    '100%' => ['transform' => 'rotateY(0deg)'],
]);

Css::style('.wrapper .flip-90-0', ['animation' => 'flip-90-0 0.6s linear', 'opacity' => 1]);
Css::style('.wrapper .flip-m90-0', ['animation' => 'flip-m90-0 0.6s linear', 'opacity' => 1]);
Css::style('.wrapper .flip-0-90', [
    'animation' => 'flip-0-90 0.6s linear',
]);
Css::style('.wrapper .flip-0-m90', [
    'animation' => 'flip-0-m90 0.6s linear',
]);
Css::style('.wrapper > div', [
    'position' => 'absolute',
    'left' => '0',
    'bottom' => '0',
    'width' => '100%',
    'box-shadow' => '0 0 40px #BDBDBD',
    'animation-fill-mode' => 'both',
]);
/* touch */
Css::keyframes('zoomIn', ['to' => ['transform' => 'scale(1.3)']]);
Css::keyframes('touchIn', [
    '0%' => ['transform' => 'scale(1.5)', 'opacity' => 0],
    '100%' => ['transform' => 'scale(1)', 'opacity' => 1],
]);
Css::style('#touch-us .her', ['background-image' => "url($imgHost/her.png)"]);
Css::style('#touch-us .me', ['background-image' => "url($imgHost/me.png)"]);
Css::keyframes('herKiss', ['to' => ['transform' => 'rotateZ(-10deg) translate3d(8%, 2%, 0)']]);
Css::keyframes('meKiss', ['to' => ['transform' => 'rotateZ(-10deg) translateZ(0) translateX(-10%)']]);
Css::style('.kiss > #touch-us .her', ['animation' => 'herKiss 0.5s ease-out']);
Css::style('.kiss > #touch-us .me', ['animation' => 'meKiss 0.5s ease-out']);
Css::style('.kiss > #touch-us > div', ['animation' => 'zoomIn 0.5s ease-out']);
Css::style('#music', [
    'width' => '50px',
    'height' => '50px',
    'position' => 'absolute',
    'right' => '10px',
    'top' => '10px',
    'z-index' => '2',
    'border-radius' => '50%',
    'background' => "black url($this->imgHost/us_cd.png) no-repeat center center",
    'background-size' => '50%',
]);
Css::style('.wrapper .album > div .cover', [
    'width' => '90%',
    'height' => '80%',
    'top' => '1rem',
    'margin' => '0 auto',
    'position' => 'relative',
    'overflow' => 'hidden',
]);
Css::style('#items > div', [
    'width' => '150px',
    'height' => '100px',
    'background' => "url($this->imgHost/25.png) no-repeat",
    'background-size' => '100%',
    'text-align' => 'center',
    'line-height' => '100px',
    'display' => 'inline-block',
    'position' => 'relative',
    'margin-bottom' => '1rem',
]);
Css::style('.start', [
    'position' => 'absolute',
    'width' => '120px',
    'height' => '120px',
    'background' => "url($this->imgHost/flowers.png) -402px -270px no-repeat",
    'left' => '50%',
    'top' => '50%',
    'margin-left' => '-60px',
    'margin-top' => '-60px',
]);
Css::style('.wrapper .welcome .circle', [
    'width' => '100%',
    'height' => '50%',
    'position' => 'relative',
    'background' => "url($this->imgHost/ring.png) no-repeat 2px 6px",
    'background-size' => '100%',
    'z-index' => '2',
    'opacity' => 0,
]);

Css::style('.welcome>.wedding-photo', ['height' => '320px', 'position' => 'absolute', 'width' => '100%', 'opacity' => 0, 'z-index' => 0]);

Css::style('.welcome>.wedding-photo>div', [
    'background' => "url($this->imgHost/6.jpg) no-repeat center center",
    'background-size' => '100%',
    'position' => 'absolute',
    'top' => '0',
    'left' => '-3%',
    'width' => '100%',
    'height' => '100%',
    'transform' => 'scale(0.8)',
    'border-radius' => '50%',
]);

if ($this->plan == 'A') {
    Css::style('#touch-us', [
        'height' => '3rem',
        'width' => '3rem',
        'position' => 'absolute',
        'right' => '1rem',
        'bottom' => '1rem',
        'box-shadow' => '0 0 10px black',
        'overflow' => 'hidden',
        'background-color' => 'rgba(255, 255, 255, 0.8)',
        'z-index' => '100',
        'display' => 'block',
    ]);
    Css::style('.love-story > div', ['width' => '90%', 'padding-bottom' => '3rem', 'margin' => '0 auto']);
    Css::style('.love-story .line', ['font-size' => '14px', 'margin-bottom' => '1rem']);
    Css::style('.love-story .line>.year', ['font-weight' => 'bolder']);
    Css::style('.love-story .line>.story:before', ['content' => '", "']);
    Css::style('.love-story .line>.story', ['word-break' => 'break-word']);
    Css::keyframes('lineIn', ['from' => ['transform' => 'translateY(-20px)', 'opacity' => 0], 'to' => ['opacity' => 1]]);
    Css::style('.line-in', ['animation' => 'lineIn 1.5s ease-out', 'animation-fill-mode' => 'forwards']);
    Css::style('.love-story .line>.story', ['word-break' => 'break-word']);
    Css::style('.wrapper .love-story > div > div.title', ['opacity' => 1]);
} else {
    Css::style('#touch-us', [
        'width' => '100%',
        'left' => '0',
    ]);
    Css::keyframes('zoomOut', ['from' => ['transform' => 'scale(1)'], 'to' => ['transform' => 'scale(0.2) translate(50%,100%)']]);
    Css::style('.kiss.zoom-out', ['animation' => 'zoomOut 1s ease-in-out', 'transform-origin' => '0 0', 'opacity' => 1, 'animation-fill-mode'=> 'forwards']);
    Css::style('.anchor', ['margin-bottom' => '0.5rem', 'display' => 'inline-block', 'width' => '100%']);
    Css::style('.anchor canvas', ['width' => '50px', 'height' => '50px', 'vertical-align' => 'top', 'float' => 'left']);
    Css::style('.anchor>div', ['display' => 'inline-block', 'vertical-align' => 'top']);
    Css::style('.anchor>div.year', ['width' => '40px', 'line-height' => '50px', 'font-size' => '12px', 'float' => 'left']);
    Css::style('.anchor>div.words', ['width' => '150px', 'background-color' => '#FF7070', 'border-radius' => '5px', 'padding' => '5px', 'float' => 'right']);
    Css::style('.anchor .heart-chart', []);
}


Css::style('#touch-us.touch-in', ['animation' => 'touchIn 0.5s ease-in-out']);
Css::style('#touch-us', ['animation-fill-mode' => 'forwards !important']);

Css::style('transition', ['transition' => 'transform 1s']);

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
Css::style('#love-movie .description', ['position' => 'absolute', 'text-align' => 'center', 'width' => '100%', 'padding-top' => '2rem']);
Css::style('#love-movie .description>div', ['opacity' => 0]);
Css::style('#love-movie .description>div:nth-child(1)', ['position' => 'relative', 'left' => '-10%']);
Css::style('#love-movie .description>div:nth-child(3)', ['position' => 'relative', 'left' => '10%']);

Css::style('.scale-0', ['transform' => 'scale(0)']);

Css::style('#touch-us', ['border-radius' => fk::$app->request->isAndroid ? '10px' : '50%']);

Css::keyframes('arrowLeft', [
    '0%' => ['transform' => 'rotateZ(135deg) translate(-1rem, -1rem)', 'opacity' => 0],
    '50%' => ['transform' => 'rotateZ(135deg) translate(-0.5rem, -0.5rem)', 'opacity' => 1],
    '100%' => ['transform' => 'rotateZ(135deg) translate(0,0)', 'opacity' => 0],
]);
Css::keyframes('arrowRight', [
    '0%' => ['transform' => 'rotateZ(-45deg) translate(-1rem, -1rem)', 'opacity' => 0],
    '50%' => ['transform' => 'rotateZ(-45deg) translate(-0.5rem, -0.5rem)', 'opacity' => 1],
    '100%' => ['transform' => 'rotateZ(-45deg) translate(0,0)', 'opacity' => 0],
]);
Css::style('.arrow', ['width' => '1.5rem', 'height' => '1.5rem', 'position' => 'absolute', 'top' => '50%', 'z-index' => 1, 'animation' => '2s ease-in-out infinite']);
Css::style('.arrow:before, .arrow:after', [
    'content' => '""',
    'width' => '70%',
    'height' => '70%',
    'display' => 'inline-block',
    'box-shadow' => '-4px -4px 0 rgba(167, 167, 167, 0.9) inset',
    'position' => 'absolute',
]);

Css::style('.arrow:before', ['top' => 0, 'left' => 0]);
Css::style('.arrow:after', ['bottom' => 0, 'right' => 0]);
Css::style('.arrow.left', ['left' => '0.2rem', 'animation-name' => 'arrowLeft']);
Css::style('.arrow.right', ['right' => '0.2rem', 'animation-name' => 'arrowRight']);
Css::style('.arrow.disabled', ['animation-name' => '""', 'display' => 'none']);
Css::keyframes('trembleClockwise', [
    '0%, 100%' => ['transform' => 'rotateY(0deg)'],
    '25%' => ['transform' => 'rotateY(-5deg)'],
    '75%' => ['transform' => 'rotateY(5deg)'],
]);
Css::keyframes('trembleAnticlockwise', [
    '0%, 100%' => ['transform' => 'rotateY(0deg)'],
    '25%' => ['transform' => 'rotateY(5deg)'],
    '75%' => ['transform' => 'rotateY(-5deg)'],
]);
Css::style('.tremble', ['animation' => '0.3s ease-in-out 2']);
Css::style('.tremble.clockwise', ['animation-name' => 'trembleClockwise']);
Css::style('.tremble.anticlockwise', ['animation-name' => 'trembleAnticlockwise']);
/* Register Css */
Css::register();