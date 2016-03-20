<?php

/*
 * This file is part of the ObjRef package.
 *
 * (c) Uwe Mueller <uwe@namez.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ObjRef\RemoteBundle\Tests\Unit\Service;


use ObjRef\RemoteBundle\Service\Remote\File;

class FileTest extends \PHPUnit_Framework_TestCase {
    /**
    * @var File
     */
    private $file;

    public function setUp() {
        $this->file = new File;
    }

    public function testOpen() {
        $file = tempnam(sys_get_temp_dir(), 'test');
        $f = $this->file->open($file, 'w');
        $this->assertInstanceOf('SplFileObject', $f);

        $this->setExpectedException('RuntimeException', 'failed to open stream: No such file or directory');
        $this->file->open('NON_EXISTING', 'r');
    }

    public function testRead() {
        $file = tempnam(sys_get_temp_dir(), 'test');
        file_put_contents($file, 'test123');
        $this->assertEquals('test123', $this->file->read($file));
    }

    public function testWrite() {
        $file = tempnam(sys_get_temp_dir(), 'test');
        $this->file->write($file, 'test321');
        $this->assertEquals('test321', file_get_contents($file));
    }
}
 