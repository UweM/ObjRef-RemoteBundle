<?php
namespace ObjRef\RemoteBundle\Tests\Unit\DependencyInjection;

use ObjRef\RemoteBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\ArrayNode;

class ConfigurationTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Configuration
     */
    private $conf;

    public function setUp() {
        $this->conf = new Configuration();
    }

    public function testTreeBuilder() {
        /** @var ArrayNode $tree */
        $tree = $this->conf->getConfigTreeBuilder()->buildTree();

        $this->assertInstanceOf('Symfony\Component\Config\Definition\ArrayNode', $tree);

        $childs = $tree->getChildren();
        $this->assertGreaterThanOrEqual(2, count($childs));
        $this->assertArrayHasKey('proxy_dir', $childs);
        $this->assertArrayHasKey('proxy_namespace', $childs);
        $this->assertInstanceOf('Symfony\Component\Config\Definition\ScalarNode', $childs['proxy_dir']);
        $this->assertInstanceOf('Symfony\Component\Config\Definition\ScalarNode', $childs['proxy_namespace']);
    }
}
 