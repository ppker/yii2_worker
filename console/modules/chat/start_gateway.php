<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-2-7
 * Time: 下午2:43
 * Desc:
 */

use \Workerman\Worker;
use \GatewayWorker\Gateway;
use Yii;
// require_once __DIR__ . "/../../../vendor/autoload.php";
$gateway = new Gateway("Websocket://0.0.0.0:7272");
$gateway->name = 'ChatGateway';
$gateway->count = 4;
$gateway->lanIp = '127.0.0.1';
$gateway->startPort = 2300;

$gateway->pingInterval = 10;
$gateway->pingData = '{"type": "ping"}';
$gateway->registerAddress = '127.0.0.1:1236';

/*$gateway->onConnect = function($connection) {

    $connection->onWebSocketConnect = function($connection, $http_header) {
        if ($_SERVER['HTTP_ORIGIN'] != 'http://chat.workerman.net') {
            $connection->close();
        }
    };
};*/


if (!defined('GLOBAL_START')) {
    Worker::runAll();
}