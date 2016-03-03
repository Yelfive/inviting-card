<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

namespace fk\web;

defined('DEBUG') or define('DEBUG', false);

use fk;
use fk\base\Object;
use fk\wechat\Js;

class Application extends Object
{
    /**
     * Different plan differs in effects
     * @var string Plan A or B
     */
    public $plan = 'A';
    public $version = '1.0.1';
    public $imgHost = 'http://7xqb7r.com1.z0.glb.clouddn.com/images/inviting';
//    public $imgHost = 'images';

    public static function run()
    {
        fk::init();
        (new static)->render();
    }

    public function render()
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

        $imgHost = $this->imgHost;
        $title = '黄伍&谢凤Wedding-我们结婚啦';
        include "$viewPath/$page.php";
    }

    public static function currentUrl()
    {
        return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}
