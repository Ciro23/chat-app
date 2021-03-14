<?php

use Ratchet\WebSocket\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {

    /**
     * @var SplObjectStorage $clients
     */
    protected $clients;

    public function __construct() {
        $this->clients = new SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        
        echo "\n" . $conn->resourceId . " has joined";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach($this->clients as $client) {
            // doesn't send the message to himself
            if ($client !== $from) {
                $client->send($msg);
            }
        }

        echo "\n" . $from->resourceId . ": " . $msg;
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

        echo "\n" . $conn->resourceId . " has left";
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
        $conn->close();

        echo "\n" . $e->getMessage();
    }
}