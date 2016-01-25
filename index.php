<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
define('__APP__', __DIR__);
define('DEBUG', true);
include __APP__ . '/library/fk.php';

// todo home page -> touch button
// todo theme, inviting

\fk\web\Application::run();