<?php
namespace ObjRef\RemoteBundle\Tests\Unit\DependencyInjection;

use ObjRef\RemoteBundle\DependencyInjection\ObjRefRemoteExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ObjRefRemoteExtensionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var ObjRefRemoteExtension
     */
    private $extension;

    public function setUp() {
        $this->extension = new ObjRefRemoteExtension();
    }

    public function testLoad() {
        $container = new ContainerBuilder();
        $this->extension->load([], $container);
        foreach(['proxy_dir', 'proxy_namespace'] as $key) {
            #$this->assertTrue($container->hasParameter('objref.'.$key));
            #$this->assertNotEmpty($container->getParameter('objref.'.$key));
        }
    }
}
