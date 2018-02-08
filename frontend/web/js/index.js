/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-2-6
 * Time: 下午4:08
 * Desc:
 */

(function($) {

    "use strict";
    var WEB_SOCKET_SWF_LOCATION = "../swf/WebSocketMain.swf";
    // 开启flash的websocket的debug
    var WEB_SOCKET_DEBUG = true;
    var f_main = function() {

        var ws = null,
            name = '',
            client_list = {},
            connection = null,
            onopen = null,
            onclose = null,
            onerror = null,
            onmessage = null,
            show_prompt = null,
            room_id = 1,
            push_message = null,
            say = null,
            main = null,
            flush_sidebar = null,
            mark_end = null;

        push_message = function() {
            $(".bottom_button").on("click", '#b_submit', function(e) {
                var tem_message = $("div.m_text textarea").val();
                var tem_user_id = $(".g_list ul li.active:eq(0)").attr('user_id');
                var tem_user_name = $(".g_list ul li.active:eq(0)").attr('user_name');
                var tem_send_message = '{"type": "say", "to_client_id": "' + tem_user_id + '", "to_client_name": "' + tem_user_name + '", "content": "' + tem_message.replace(/"/g, '\\"').replace(/\n/g, '\\n').replace(/\r/g, '\\r') + '"}';


                ws.send(tem_send_message);
                $("div.m_text textarea").val("");
                $("div.m_text textarea").focus();
                e.preventDefault();
            });
        };


        show_prompt = function() {
            name = prompt("请输入你的名字:", '');
            if (!name || name == 'null' || name == 'undefined') {
                name = '可恶的人类';
            }
        };

        onopen = function() {

            if (!name) show_prompt();
            // 进行登录
            var login_data = '{"type": "login", "client_name": "' + name.replace(/"/g, '\\"') + '", "room_id": "' + room_id + '"}';
            ws.send(login_data);
        };

        onclose = function() {
            console.log("链接关闭，定时重连");
            connect();
        };

        onerror = function() {
            console.log("出现错误");
        };

        onmessage = function(e) {
            var data = eval("(" + e.data + ")");

            switch(data.type) {
                case 'pinig':
                    ws.send('{"type": "pong"}');
                    break;

                case 'login':
                    say({
                        'client_id': data['client_id'],
                        'client_name': data['client_name'],
                        'message': data['client_name'] + ' 加入了聊天室',
                        'time': data['time'],
                    });
                    if (data['client_list']) {
                        client_list = data['client_list'];
                    } else client_list[data['client_id']] = data['client_name'];
                    // 刷新sidebar
                    flush_sidebar(client_list);
                    break;

                case 'say':
                    say({
                        'client_id': data['from_client_id'],
                        'client_name': data['from_client_name'],
                        'message': data['content'],
                        'time': data['time'],
                    });
                    break;

                case 'logout':
                    say({
                        'client_id': data['from_client_id'],
                        'client_name': data['from_client_name'],
                        'message': data['from_client_name'] + '退出了',
                        'time': data['time'],
                    });
                    delete client_list[data['from_client_id']];
                    flush_sidebar(client_list);
            }
        };

        flush_sidebar = function(arr) {
            $("div.g_list ul").empty();
            $.each(arr, function(i, v) {
                $("div.g_list ul").append(
                    '<li class="active" user_id="' + i + '" user_name="' + v + '">' +
                    '<img class="avatar" width="30" height="30" alt="ppker" src="/img/limomo_little.jpg">' +
                    '<div class="m_name">' + v + '</div>' +
                    '</li>'
                )
            })

        };

        connection = function() {

            ws = new WebSocket("ws://" + document.domain + ":7272");
            ws.onopen = onopen;
            ws.onmessage = onmessage;
            ws.onclose = onclose;
            ws.onerror = onerror;
        };

        say = function(data) {
            $("div.m_message ul").append(
                '<li>' +
                '<div class="time"><span>' + data.time + '</span></div>' +
                '<div class="main">' +
                '<img class="avatar" width="30" height="30" alt="ppker" src="/img/limomo_little.jpg">' +
                '<div class="text">' +
                data['message'] +
                '</div></div></li>'
            )
        };

        main = function() {
            connection();
            push_message();
        };

        main();
    };

    f_main();

})(jQuery);