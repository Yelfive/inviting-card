<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
define('__APP__', __DIR__);
define('DEBUG', true);
include __APP__ . '/library/fk.php';

// todo: video loading
// todo: wechat sharing

\fk\web\Application::run();