<?php

/*
 * This file is part of the ObjRef package.
 *
 * (c) Uwe Mueller <uwe@namez.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $this->assertGreaterThanOrEqual(0, count($childs));
    }
}
 