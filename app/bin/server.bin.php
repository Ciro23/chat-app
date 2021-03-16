<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use GSoares\RatchetChat\Chat;

require __DIR__ . '/../../vendor/autoload.php';

// saves the env vars in the $_ENV superglobal
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../config/");
$dotenv->load();

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new \Chat()
        )
    ),
    $_ENV['port']
);

$server->run();