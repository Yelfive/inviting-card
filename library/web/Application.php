<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

namespace fk\web;

use fk;
use fk\base\Object;
use fk\wechat\Js;


class Application extends Object
{
    public static function run()
    {
        fk::init();
        static::render();
    }

    public static function render()
    {
        $wechat = new Js();
        $ticket = $wechat->ticket;
        $appId = $wechat->appId;
        $nonceStr = time();
        $timestamp = time();
//        $signature = http_build_str([
//            'jsapi_ticket' => $ticket,
//            'noncestr' => time(),
//            'timestamp' => time(),
//            'url' => $_SERVER['HTTP_REFERER'],
//        ]);
        $url = static::currentUrl();
        $signature = sha1("jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url");
        include __APP__ . '/views/index.php';
    }

    public static function currentUrl()
    {
        return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}