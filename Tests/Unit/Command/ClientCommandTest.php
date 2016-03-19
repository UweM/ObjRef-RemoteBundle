<?php
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
 