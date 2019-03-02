<?php
// 帖子：https://www.v2ex.com/t/540212
// 这个是客户端，嵌入在自己网站里，每次访问执行一次 updateCount 就可以了
function updateCount($sendMsg = '', $ip = '127.0.0.1', $port = 9588){
	$handle = stream_socket_client("udp://{$ip}:{$port}", $errno, $errstr);
	if(!$handle){
		die("Error");
	}
	fwrite($handle, $sendMsg."\n");
	$result = fread($handle, 1024);
	fclose($handle);
	return $result;
}
// 每次访问网页就执行下这个
updateCount('你给我更新啊 +1');
