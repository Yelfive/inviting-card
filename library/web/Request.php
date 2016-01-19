<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
namespace fk\web;

use fk\base\Object;

/**
 * @property string $terminal
 */
class Request extends Object
{
    public function getTerminal()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (strrpos($agent, 'Mobile')) {
            return 'mobile';
        } else {
            return 'pc';
        }
    }
}