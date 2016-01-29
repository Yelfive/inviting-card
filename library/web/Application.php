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
        $url = static::currentUrl();
        $signature = sha1("jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url");

        $viewPath = __APP__ . '/views';
        $page = empty($_GET['p']) || !in_array($_GET['p'], ['index', 'video']) ? 'index' : $_GET['p'];
        $imgHost = 'http://7xqb7r.com1.z0.glb.clouddn.com/images/inviting';
        $title = '黄伍&谢凤-我们结婚啦';
        include "$viewPath/$page.php";
    }

    public static function currentUrl()
    {
        return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}