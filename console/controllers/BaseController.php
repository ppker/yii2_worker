<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-2-6
 * Time: 下午5:40
 * Desc:
 */

namespace console\controllers;

use Yii;
use Workerman\Worker;
use yii\console\Controller;

class BaseController extends Controller {

    public function init() {

        ini_set('memory_limit', '2000M');
        ini_set('display_errors', 'on');

        if (strpos(strtolower(PHP_OS), 'win') === 0) exit("this app not support windows, please use linux os");
        if (!extension_loaded('pcntl')) exit("Please install pcntl. See http://doc3.workerman.net/appendices/install-extension.html\n");
        if (!extension_loaded('posix')) exit("Please install posix. See http://doc3.workerman.net/appendices/install-extension.html\n");
        parent::init();
    }
}