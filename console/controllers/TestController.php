<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-2-6
 * Time: 下午5:25
 * Desc:
 */

namespace console\controllers;
use Workerman\Worker;
use Yii;
global $yii_app;
class TestController extends BaseController {

    public function actionIndex() {

        die('abc');
        global $yii_app;
        $yii_app = Yii::$app;
        define('GLOBAL_START', 1);

        /*require_once __DIR__ . "/test.php";
        foreach (glob(__DIR__ . "/../modules/chat/start*.php") as $start_file) {
            require_once $start_file;
        }
        $cmd = 'php ' . __DIR__ . '/start.php start';
        shell_exec($cmd);*/
        $cmd = 'php ' . __DIR__ . '/test1.php start';
        /*require_once __DIR__ . "/test1.php";
        $cmd = 'php ' . __DIR__ . "/start.php start";*/
        shell_exec($cmd);
        sleep(5);
        echo "sssss";return;
    }
}