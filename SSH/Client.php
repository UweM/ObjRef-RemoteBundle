<?php
namespace ObjRef\RemoteBundle\SSH;

use ObjRef\Transport\ClientInterface;


/**
 * this is just a wrapper class to match the interface
 * @codeCoverageIgnore
 */
class Client implements ClientInterface {

    /**
     * @var \Net_SSH2
     */
    private $ssh;

    public function __construct() {
        /** @noinspection PhpUnusedParameterInspection */
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            throw new SSHException($errstr);
        }, E_USER_NOTICE);
    }

    public function connect($host, $port, $timeout=10) {
        $this->ssh = new \Net_SSH2($host, $port, $timeout);
    }

    public function createCmdChannel($cmd) {
        return $this->ssh->exec($cmd, false);
    }

    public function closeChannel() {
        $this->ssh->_close_channel(NET_SSH2_CHANNEL_EXEC);
    }

    public function read() {
        return $this->ssh->_get_channel_packet(NET_SSH2_CHANNEL_EXEC);
    }

    public function write($data) {
        return $this->ssh->_send_channel_packet(NET_SSH2_CHANNEL_EXEC, $data);
    }

    public function disconnect() {
        $this->ssh->disconnect();
    }

    public function login($username) {
        $args = func_get_args();
        array_unshift($args, $username);
        return call_user_func_array([$this->ssh, 'login'], $args);
    }

    public function getErrors() {
        return $this->ssh->getErrors();
    }
}
