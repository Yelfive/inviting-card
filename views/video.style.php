<?php

Css::keyframes('heartbeats', [
    '0%' => ['transform' => 'scale(0.8)'],
    '50%' => ['transform' => 'scale(1)'],
    '100%' => ['transform' => 'scale(0.8)'],
]);

Css::keyframes('bounceOut', [
    'to' => ['transform' => 'scale(2)', 'opacity' => 0],
]);

Css::style('#loading canvas', [
    'animation' => 'heartbeats 1s ease infinite'
]);

Css::style('#loading.bounceOut', [
    'animation' => 'bounceOut 0.5s ease-in-out'
]);

//Css::style('.video-out', ['transform' => 'scale(0)']);

Css::register();