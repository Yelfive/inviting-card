<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

namespace fk\cache;

class FileCache
{

    public $cacheDir = 'cache';

    public function __construct($config = [])
    {
        $this->cacheDir = $config['cacheDir'];
    }

    public function get($name)
    {
        $caches = $this->fetchAllCaches();
        return isset($caches[$name]) ? $caches[$name][0] : null;
    }

    public function set($name, $value, $duration = 0)
    {
        $caches = $this->fetchAllCaches();
        $caches[$name] = [$value, time(), $duration];
        $this->writeCaches($caches);
        return true;
    }

    protected function fetchAllCaches()
    {
        $file = $this->file();
        if (!is_file($file)) {
            return [];
        }
        $caches = json_decode(file_get_contents($file), true);
        if (!is_array($caches)) {
            return [];
        }
        $changed = false;
        foreach ($caches as $name => $cache) {
            if ($cache[2] !== 0 && $cache[1] + $cache[2] <= time()) {
                unset($caches[$name]);
                $changed = true;
            }
        }
        $changed && $this->writeCachesProbably($caches);
        return $caches;
    }

    /**
     * Writing cache probably
     * @param array $caches
     * @return bool
     */
    protected function writeCachesProbably($caches)
    {
        if (rand(1, 10) > 5) {
            $this->writeCaches($caches);
        }
        return true;
    }

    protected function writeCaches($caches)
    {
        file_put_contents($this->file(), json_encode($caches, JSON_UNESCAPED_UNICODE));
        return true;
    }

    protected function file()
    {
        $cacheDir = __APP__ . '/runtime/cache';
        is_dir($cacheDir) || mkdir($cacheDir, 0755, true);
        $cacheFile = "$cacheDir/$this->cacheDir";
        return $cacheFile;
    }

}