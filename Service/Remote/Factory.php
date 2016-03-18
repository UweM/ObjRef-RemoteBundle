<?php
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
