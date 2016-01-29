<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
define('__APP__', __DIR__);
define('DEBUG', false);
include __APP__ . '/library/fk.php';

// todo theme, inviting

\fk\web\Application::run();