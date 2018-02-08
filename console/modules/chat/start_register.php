<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-2-7
 * Time: 下午2:37
 * Desc:
 */

use \Workerman\Worker;
use \GatewayWorker\Register;
// require_once __DIR__ . "/../../../vendor/autoload.php";
$register = new Register('text://0.0.0.0:1236');
if (!defined('GLOBAL_START')) {
    Worker::runAll();
}
