<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
define('__APP__', __DIR__);
define('DEBUG', true);
// TODO: video,loading, thumb up, location unfinished
// TODO: check document.load
// TODO: music auto-play
include __APP__ . '/library/fk.php';

\fk\web\Application::run();