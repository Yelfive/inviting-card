<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

namespace fk\wechat;

use Exception;
use fk;
use fk\base\Object;

/**
 *
 * @property string $appId
 * @property string $secret
 * @property string $accessToken
 *
 */
class Base extends Object
{

    public function getAccessToken()
    {
        if ($token = fk::$app->cache->get('access_token')) {
            return $token;
        }

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret=$this->secret";
        $response = fk::$app->curl->get($url);
        if ($response) {
            $this->throwError($response);
            fk::$app->cache->set('access_token', $response['access_token'], $response['expires_in']);
            return $response['access_token'];
        }
        return null;
    }

    protected function throwError(&$response)
    {
        if ($response && $response['errcode']) {
            throw new Exception("Failed to fetch access token:$response[errmsg]($response[errcode])");
        }

    }

    public function getAppId()
    {
        return 'wx0be266702a6567a6';
    }

    protected function getSecret()
    {
        return 'b11ca215130a194ca0c2002cd547ce27';
    }

}