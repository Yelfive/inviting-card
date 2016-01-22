<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

namespace fk\wechat;

use fk;

/**
 * @property string $ticket
 */

class Js extends Base
{

    public function getTicket()
    {
        $key = "js_api_ticket_$this->appId";
        if ($ticket = fk::$app->cache->get($key)) {
            return $ticket;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$this->accessToken&type=jsapi";
        if ($response = fk::$app->curl->get($url)) {
            $this->throwError($response);
            fk::$app->cache->set($key, $response['ticket'], $response['expires_in']);
            return $response['ticket'];;
        } else {
            return null;
        }
    }

}