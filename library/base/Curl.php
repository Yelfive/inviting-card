<?php
/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

namespace fk\base;


/**
 * Class Curl
 * @package fk\base
 * @method Curl asJson
 * @method Curl asString
 */
class Curl
{

    protected $heads = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
    ];
    protected $format = 'json';

    public function addOption($name, $value)
    {
        $this->heads[$name] = $value;
        return $this;
    }

    public function addOptions($headers)
    {
        foreach ($headers as $head => $value) {
            $this->addOption($head, $value);
        }
        return $this;
    }

    public function post()
    {
        return $this->addOption(CURLOPT_POST, true)
            ->execute();
    }

    public function get($url)
    {
        return $this->addOptions([
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
        ])->execute();
    }

    public function execute()
    {
        $ch = curl_init();
        foreach ($this->heads as $name => $value) {
            curl_setopt($ch, $name, $value);
        }
        $response = curl_exec($ch);
        curl_close($ch);
        switch ($this->format) {
            case 'json':
                return json_decode($response, true);
            default :
                return $response;
        }
    }

    public function __call($name, $params) {
        if (strpos($name, 'as') === 0) {
            $this->format = lcfirst(substr($name, 2));
            return $this;
        }
    }

}