<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-2-7
 * Time: 下午4:29
 * Desc:
 */

use \GatewayWorker\Lib\Gateway;


class Events {

    public static function onMessage($client_id, $message) {

        global $yii_app;

        // var_dump($yii_app->db);

        echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_ADDR']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']} client_id:$client_id
         session:" . json_encode($_SESSION) . " onMessage:" . $message . "\n";

        // 客户端传递的是json数据
        $message_data = json_decode($message, true);
        if (empty($message_data) || !$message_data) return;
        // 根据类型执行不同的业务

        switch ($message_data['type']) {
            case 'pong': // 客户端回应服务端的心跳
                return;
            case 'login':
                if (!isset($message_data['room_id'])) throw new \Exception("\$message_data['room_id'] not set. client_ip:{$_SERVER['REMOTE_ADDR']} \$message:$message");
                $room_id = $message_data['room_id'];
                $client_name = htmlspecialchars($message_data['client_name']);
                $_SESSION['room_id'] = $room_id;
                $_SESSION['client_name'] = $client_name;

                // 获取房间内的所有用户列表
                $clients_list = Gateway::getClientSessionsByGroup($room_id);
                foreach ($clients_list as $tem_client_id => $item) {
                    $clients_list[$tem_client_id] = $item['client_name'];
                }
                $clients_list[$client_id] = $client_name;

                // 转播给当前聊天室的所有客户端 尊贵的xxxVip会员进入聊天室
                $new_message = [
                    'type' => $message_data['type'],
                    'client_id' => $client_id,
                    'client_name' => htmlspecialchars($client_name),
                    'time' => date('Y-m-d H:i:s'),
                ];
                Gateway::sendToGroup($room_id, json_encode($new_message));
                Gateway::joinGroup($client_id, $room_id);
                // 给当前用户发送用户列表
                $new_message['client_list'] = $clients_list;
                Gateway::sendToCurrentClient(json_encode($new_message));
                return;

            case 'say':
                if (!isset($_SESSION['room_id'])) throw new \Exception("\$_SESSION['room_id'] not set. client_ip:{$_SERVER['REMOTE_ADDR']}");
                $room_id = $_SESSION['room_id'];
                $client_name = $_SESSION['client_name'];
                // 私聊
                if ('all' != $message_data['to_client_id']) {
                    $new_message = [
                        'type' => 'say',
                        'from_client_id' => $client_id,
                        'from_client_name' => $client_name,
                        'to_client_id' => $message_data['to_client_id'],
                        'content' => "<b>对你说: </b>" . nl2br(htmlspecialchars($message_data['content'])),
                        'time' => date('Y-m-d H:i:s'),
                    ];
                    Gateway::sendToClient($message_data['to_client_id'], json_encode($new_message));
                    $new_message['content'] = "<b>你对" . htmlspecialchars($message_data['to_client_name']) . "说: </b>" . nl2br(htmlspecialchars($message_data['content']));
                    return Gateway::sendToCurrentClient(json_encode($new_message));
                }
                // 全聊
                $new_message = [
                    'type' => 'say',
                    'from_client_id' => $client_id,
                    'from_client_name' => $client_name,
                    'to_client_id' => 'all',
                    'content' => nl2br(htmlspecialchars($message_data['content'])),
                    'time' => date('Y-m-d H:i:s'),
                ];
                return Gateway::sendToAll($room_id, json_encode($new_message));

        }



    }

    public static function onClose($client_id) {

        echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']} 
        client_id:$client_id onClose: \n";
        if (isset($_SESSION['room_id'])) {
            $room_id = $_SESSION['room_id'];
            $new_message = [
                'type' => 'logout',
                'from_client_id' => $client_id,
                'from_client_name' => $_SESSION['client_name'],
                'time' => date('Y-m-d H:i:s'),
            ];
            return Gateway::sendToGroup($room_id, json_encode($new_message));
        }
    }


}