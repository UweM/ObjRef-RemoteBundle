<?php

/*
 * This file is part of the ObjRef package.
 *
 * (c) Uwe Mueller <uwe@namez.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ObjRef\RemoteBundle\Tests\Unit\Command;

use ObjRef\RemoteBundle\Command\ClientCommand;

class ClientCommandTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var ClientCommand
     */
    private $command;
    public function setUp() {
        $this->command = new ClientCommand();
    }

    public function testName() {
        $this->assertEquals('objref:client', $this->command->getName());
    }
}
 