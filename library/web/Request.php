<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
namespace fk\web;

use fk\base\Object;

/**
 * @property string $terminal pc or mobile
 * @property boolean $isAndroid
 * @property boolean $isWechat
 */
class Request extends Object
{
    public function getTerminal()
    {
        $agent = $this->agent();
        if (strrpos($agent, 'Mobile')) {
            return 'mobile';
        } else {
            return 'pc';
        }
    }

    protected function agent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public function getIsAndroid()
    {
        return strpos($this->agent(), 'Android') !== false;
    }

    public function getIsWechat()
    {
        return strpos($this->agent(), 'MicroMessenger') !== false;
    }

}