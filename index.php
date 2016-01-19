<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
define('__APP__', __DIR__);
define('DEBUG', true);
// TODO: video, thumb up
// TODO: check document.load
include __APP__ . '/library/fk.php';

\fk\web\Application::run();