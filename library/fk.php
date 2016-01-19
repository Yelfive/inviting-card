<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

use fk\base\Curl;
use fk\cache\FileCache;

define('FK_PATH', __DIR__);

spl_autoload_register(['fk', 'autoload']);

class fk
{

    public static $aliases = [
        '@fk' => FK_PATH,
    ];

    /**
     * @var FKComponents
     */
    public static $app;

    public static function init()
    {
        static::$app = new FKComponents();
    }


    public static function getAlias($name)
    {
        if (strpos($name, '@') !== 0) {
            throw new Exception('Invalid alias name');
        }
        $name = str_replace('\\', '/', $name);

        $alias = strstr($name, '/', true);
        if (isset(static::$aliases[$alias])) {
            return static::$aliases[$alias] . strstr($name, '/');
        } else {
            throw new Exception("Undefined alias: $alias($name)");
        }
    }

    public static function autoload($name)
    {
        $filePath = static::getAlias("@$name.php");
        if (is_file($filePath)) {
            include_once $filePath;
        } else {
            throw new Exception("Failed to autoload class: $name");
        }
    }

    public static function log()
    {

    }


}

/**
 * Class FKComponents
 * @package fk
 * @property \fk\base\Curl $curl
 * @property \fk\cache\FileCache $cache
 * @property \fk\web\Request $request
 */
class FKComponents
{
    public $components = [
        'curl' => 'fk\base\Curl',
        'cache' => [
            'class' => 'fk\cache\FileCache',
            'cacheDir' => 'wechat',
        ],
        'request' => 'fk\web\Request',
    ];

    private $_loadedComponents = [];

    public function __get($name)
    {
        if (isset($this->components[$name])) {
            if (isset($this->_loadedComponents[$name])) {
                return $this->_loadedComponents[$name];
            } else if (is_array($this->components[$name])) {
                $params = $this->components[$name];
                $class = $params['class'];
                unset($params['class']);
            } else {
                $class = $this->components[$name];
                $params = [];
            }
            return $this->_loadedComponents[$name] = new $class($params);
        }
    }

}