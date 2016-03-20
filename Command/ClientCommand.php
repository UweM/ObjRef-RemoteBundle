<?php

/*
 * This file is part of the ObjRef package.
 *
 * (c) Uwe Mueller <uwe@namez.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ObjRef\RemoteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ObjRef\Proxy;
use ObjRef\Transport\FDTransport;
use ObjRef\Transport\StreamClosedException;

class ClientCommand extends ContainerAwareCommand {


    protected function configure() {
        $this
            ->setName('objref:client')
            ->setDescription('Client command for ObjRef communication. Do not call manually')
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     * @throws \RuntimeException
     */
    protected function execute(InputInterface $input, OutputInterface $output) {

        $transport = new FDTransport(STDIN, STDOUT);

        $host = $this->getContainer()->get('objref.host');
        $host->setTransport($transport);
        try {
            $host->run();
        } catch (StreamClosedException $e) {
            // ignore closed stream
        }

    }

}


