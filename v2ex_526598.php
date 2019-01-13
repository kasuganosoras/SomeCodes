<?php
/**
 *
 *  一个简单的示例，自动给注册了但是未验证的用户发送短信
 *
 *  假设数据库的字段是这样的
 *
 *  | id | username | mobile | email | status | sended |
 *
 */
include("sms.php"); // 调用发送短信的类，此处仅用于示例
$sms = new SMS(); // 调用发送短信的类
while(true) {
  $conn = mysqli_connect("localhost", "user", "pass", "database"); // 连接数据库
  $rs = mysqli_query($conn, "SELECT * FROM `users` WHERE `status`='verify' AND `sended`='false'"); // 查询所有状态为 Verify（等待验证）且未发送提醒信息的用户
  while($rw = mysqli_fetch_row($rs)) {
    // $rw[2] 对应的数据库是 mobile
    $sms->send($rw[2], "尊敬的用户 {$rw[1]}，您的账号注册后还未进行验证，请及时登录您的邮箱 {$rw[3]} 查收验证邮件~");
    // 更新数据库中的状态，标记为 “已经通知”
    mysqli_query($conn, "UPDATE `users` SET `sended`='true' WHERE `id`='{$rw[0]}'");
  }
  sleep(60); // 等待一分钟后再检查一次
}
