<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

namespace fk\base;

class Obj
{
    public function __get($name)
    {
        if (method_exists($this, "get$name")) {
            return $this->{"get$name"}();
        }
    }
}