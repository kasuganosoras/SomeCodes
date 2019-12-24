/*
相关帖子：https://www.v2ex.com/t/632030
一个简单的 jQuery Ajax 请求（？）
不用谢，希望能帮到你
*/

// 初始化变量
var sessionid = 这里通过django输出变量;
var interval;

// 如果 SESSION 大于 0
if(sessionid > 0) {
    // 设置定时任务
    interval = setInterval(function() {
        var htmlobj = $.ajax({
            url: " https://xx.xx.xx.xx/xxxxxx/",
            method: "GET",
            success: function() {
                // 套个 try 防止出什么奇奇怪怪的问题
                try {
                    // 解析数据
                    var json = JSON.parse(htmlobj.responseText);
                    var number = json.new_msg;
                    if(number > 0) {
                        $("#info").html("计算完成 " + number + "，点我查看");
                    }
                    if(json.waiting == 0) {
                        clearInterval(interval);
                    }
                } catch(e) {
                    // alert("服务器把什么奇奇怪怪的东西发回来了");
                    // 闷声发大财
                }
            },
            error: function() {
                // 请求错误的处理
                // alert("服务器炸了");
            }
        });
    }, 2000);
}
