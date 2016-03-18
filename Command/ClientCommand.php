<?php

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
            ->setDescription('test')
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


