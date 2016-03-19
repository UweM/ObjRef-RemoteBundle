<?php
namespace ObjRef\RemoteBundle\Tests;

use ObjRef\RemoteBundle\ObjRefRemoteBundle;
use Mockery as m;

class ObjRefRemoteBundleTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var ObjRefRemoteBundle
     */
    private $bundle;

    public function setUp() {
        $container = $this->getContainerMock();
        $this->bundle = new ObjRefRemoteBundle();
        /** @noinspection PhpParamsInspection */
        $this->bundle->setContainer($container);
    }

    private function getContainerMock() {
        $file = tempnam(sys_get_temp_dir(), 'test');
        unlink($file);
        $generator = m::mock('ObjRef\Proxy\GeneratorInterface');
        $generator
            ->shouldReceive('getFullProxyPath')
            ->with('\test\Cls')
            ->andReturn($file)
        ;
        $generator
            ->shouldReceive('getProxyNamespace')
            ->andReturn('TESTSPACE')
        ;
        $generator
            ->shouldReceive('generate')
            ->once()
            ->with('\test\Cls')
            ->andReturnUsing(function() use($file) {
                file_put_contents($file, '<?php namespace TESTSPACE; class test_Cls { }');
            })
        ;
        $container = m::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container
            ->shouldReceive('get')
            ->once()
            ->with('objref.proxy_generator')
            ->andReturn($generator)
        ;
        $container
            ->shouldReceive('getParameter')
            ->once()
            ->with('kernel.environment')
            ->andReturn('prod')
        ;
        $container
            ->shouldReceive('getParameter')
            ->once()
            ->with('objref.proxy_namespace')
            ->andReturn('TESTSPACE');
        ;
        return $container;
    }

    public function tearDown() {
        m::close();
    }

    public function testBoot() {
        $this->bundle->boot();
        // trigger loader
        $this->assertTrue(class_exists('TESTSPACE\\test_Cls'));
    }
}
 