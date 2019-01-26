<?php
$now = time();
$start = strtotime('-1 days');
$half = true;
for ($i=$start; $i<=$now; $i+=1800) {
	$mdate = date('H', $i);
	// 如果上一次循环是 30 分
	if($half) {
		$minute = "00";
		$half = false;
	} else {
		$minute = "30";
		$half = true;
	}
	echo "{$mdate}:{$minute}\n";
}
