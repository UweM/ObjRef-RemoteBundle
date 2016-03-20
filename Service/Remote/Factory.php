<?php

/*
 * This file is part of the ObjRef package.
 *
 * (c) Uwe Mueller <uwe@namez.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ObjRef\RemoteBundle\Service\Remote;

class Factory {
    /**
     * @param $class
     * @return object
     */
    public function create($class) {
        $params = func_get_args();
        array_shift($params);
        $ref = new \ReflectionClass($class);
        return $ref->newInstanceArgs($params);
    }
}
