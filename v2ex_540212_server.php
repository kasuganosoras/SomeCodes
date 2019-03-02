<?php
// 帖子：https://www.v2ex.com/t/540212
// 能够承受高并发统计网页点击量的服务端
// 需要 Swoole
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set('count', '0');
$server = new swoole_server("127.0.0.1", 9588, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
$server->redis = $redis;
$server->on('Packet', function ($server, $data, $clientInfo) {
	$count = intval($server->redis->get('count')) + 1;
	$server->redis->set('count', $count);
	$server->sendto($clientInfo['address'], $clientInfo['port'], "Server " . $count);
});
$server->on('Start', function ($server) {
	while(true) {
		echo date("[H:i:s] ") .$server->redis->get('count') . "\n";
		$conn = mysqli_connect("localhost", "root", "root", "database");
		mysqli_query($conn, "UPDATE `table` SET `value`='{$count}' WHERE `key`='count'");
		mysqli_close($conn);
		sleep(60);
	}
});
$server->start();
