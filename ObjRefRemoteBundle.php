<?php

/*
 * This file is part of the ObjRef package.
 *
 * (c) Uwe Mueller <uwe@namez.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ObjRef\RemoteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ObjRefRemoteBundle extends Bundle {
    private $autoloader;


    public function boot() {
        $namespace = $this->container->getParameter('objref.proxy_namespace');
        $gen = $this->container->get('objref.proxy_generator');
        $env = $this->container->getParameter('kernel.environment');

        $this->autoloader = function($class) use ($namespace, $gen, $env) {
            if (substr($class, 0, strlen($namespace)) === $namespace) {

                $originalClass = substr($class, strlen($namespace));
                $originalClass = str_replace('__', '_', $originalClass);
                $originalClass = str_replace('_', '\\', $originalClass);

                $file = $gen->getFullProxyPath($originalClass);

                if(!is_file($file) || $env == 'dev') {
                    $gen->generate($originalClass);
                    clearstatcache(true, $file);
                }

                if(file_exists($file)) {
                    /** @noinspection PhpIncludeInspection */
                    require $file;
                }
            }
        };
        spl_autoload_register($this->autoloader);
    }
}