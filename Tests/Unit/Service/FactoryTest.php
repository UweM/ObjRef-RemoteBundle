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


use ObjRef\RemoteBundle\Service\Remote\Factory;

class TestClass {
    public $param;
    public function __construct($param) {
        $this->param = $param;
    }
}

class FactoryTest extends \PHPUnit_Framework_TestCase {
    /**
    * @var Factory
     */
    private $factory;

    public function setUp() {
        $this->factory = new Factory();
    }

    public function testCreateNoParams() {
        $obj = $this->factory->create('\stdClass');
        $this->assertInstanceOf('\stdClass', $obj);
    }

    public function testCreateWithParams() {
        $class = '\ObjRef\RemoteBundle\Tests\Unit\Service\TestClass';
        $param = 'foobar';
        $obj = $this->factory->create($class, $param);
        $this->assertInstanceOf($class, $obj);
        $this->assertEquals($obj->param, $param);
    }
}
 