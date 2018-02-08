<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-2-7
 * Time: 下午4:14
 * Desc:
 */

use \Workerman\Worker;
use \GatewayWorker\BusinessWorker;
// require_once __DIR__ . "/../../../vendor/autoload.php";
$worker = new BusinessWorker();
$worker->name = 'ChatBusinessWorker';
$worker->count = 4;
$worker->registerAddress = '127.0.0.1:1236';
$yii_app;
$worker->onWorkerStart = function($worker) {
    require_once __DIR__ . "/../../../yii_worker.php";
    global $yii_app;
    $yii_app = Yii::$app;
    // $db = $yii_app->db;
    // $data = $db->createCommand("select * from user where `username` = 'admin'")->queryAll();
    // var_dump($data);

};


if (!defined('GLOBAL_START')) {
    Worker::runAll();
}