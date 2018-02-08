<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-2-6
 * Time: 下午4:35
 * Desc:
 */

namespace frontend\assets;
use yii\web\AssetBundle;

class SocketAsset extends AssetBundle {

    public $sourcePath = '@common/statics/assets';

    public $css = [];
    public $js = [
        'web_socket/swfobject.js',
        'web_socket/web_socket.js',
    ];
    public $depends = [];
}