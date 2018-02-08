<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
AppAsset::addScript($this, '@web/js/index.js');
$this->title = '聚财猫聊天室';
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 chat clearfix">
            <div class="sidebar pull-left">
                <div class="m_card">
                    <div class="m_header">
                        <img class="avatar" width="40" height="40" alt="avatar" src="<?= Yii::getAlias('@web/img/zgr.jpg'); ?>" />
                        <div class="m_name">Ppker</div>
                    </div>
                    <div class="m_footer">
                        <input class="search" placeholder="search user...">
                    </div>
                </div>
                <div class="g_list">
                    <ul>
                        <li class="active" user_id="" user_name="">
                            <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/limomo_little.jpg'); ?>">
                            <div class="m_name">李沫沫</div>
                        </li>
                        <li class="" user_id="" user_name="">
                            <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/zgr.jpg'); ?>">
                            <div class="m_name">九地</div>
                        </li>
                        <li class="" user_id="" user_name="">
                            <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/avatar2.jpg'); ?>">
                            <div class="m_name">辛怡</div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main">
                <div class="m_message">
                    <ul>
                        <li>
                            <div class="time"><span>11:37:21</span></div>
                            <div class="main">
                                <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/limomo_little.jpg'); ?>">
                                <div class="text">
                                    嘻嘻嘻嘻嘻 嘿嘿嘿嘿嘿嘿
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="time"><span>11:38:22</span></div>
                            <div class="main">
                                <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/limomo_little.jpg'); ?>">
                                <div class="text">
                                    平生不会相思，才会相思，便害相思。
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="time"><span>11:38:40</span></div>
                            <div class="main">
                                <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/limomo_little.jpg'); ?>">
                                <div class="text">
                                    身似浮云，心如飞絮，气若游丝。
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="time"><span>11:39:12</span></div>
                            <div class="main">
                                <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/limomo_little.jpg'); ?>">
                                <div class="text">
                                    空一缕余香在此，盼千金游子何之。
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="time"><span>11:40:03</span></div>
                            <div class="main">
                                <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/limomo_little.jpg'); ?>">
                                <div class="text">
                                    证候来时，正是何时？灯半昏时，月半明时。
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="time"><span>11:41:13</span></div>
                            <div class="main self">
                                <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/zgr.jpg'); ?>">
                                <div class="text">
                                    嘶骑渐遥，征尘不断，何处认郎踪！
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="time"><span>11:42:21</span></div>
                            <div class="main self">
                                <img class="avatar" width="30" height="30" alt="ppker" src="<?= Yii::getAlias('@web/img/zgr.jpg'); ?>">
                                <div class="text">
                                    终日劈桃穰，人在心儿里。两朵隔墙花，早晚成连理。
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="m_text">
                    <textarea placeholder="按 Enter发送">ss</textarea>
                    <div class="bottom_button"><button class="btn sb_button" id="b_submit">发送(S)</button></div>
                </div>
            </div>
        </div>
    </div>

</div>
