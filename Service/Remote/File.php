<?php
namespace ObjRef\RemoteBundle\Service\Remote;

class File {
    /**
     * @param $file
     * @param $mode
     * @return \SplFileObject
     */
    public function open($file, $mode) {
        return new \SplFileObject($file, $mode);
    }

    /**
     * @param $file
     * @return string
     */
    public function read($file) {
        return file_get_contents($file);
    }

    /**
     * @param $file
     * @param $data
     * @param int $flags
     * @return int
     */
    public function write($file, $data, $flags = 0) {
        return file_put_contents($file, $data, $flags);
    }
}
