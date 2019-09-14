<?php
/**
 * PHP GD 动态绘制会员卡图片
 * **********************************************
 * 帖子：https://www.v2ex.com/t/600721
 * 更新：现在背景图黑色部分不会变成透明了
 * 测试：https://cdn.zerodream.net/api/card/
 * 使用：Clone 到本地后，将 v2ex_600721.php 和 v2ex_600721 目录复制到你的网站目录下即可
 */

// 获取图片大小
list($width, $height, $type) = getimagesize(__DIR__ . '/v2ex_600721/images/bg.png');

// 文字内容设定
$text    = "钢板卡号：4040 2333 114 514";

// 加载资源
$font    = __DIR__ . '/v2ex_600721/fonts/mono.ttf';
$card    = imagecreatefrompng(__DIR__ . '/v2ex_600721/images/bg.png');
$image   = imagecreatetruecolor($width, $height);
$bgColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
$white   = imagecolorallocate($image, 255, 255, 255);

// 执行绘图
imagefill($image, 0, 0, $bgColor);
imagecopyresampled($image, $card, 0, 0, 0, 0, $width, $height, $width, $height);
imagefttext($image, 12, 0, 36, 215, $white, $font, $text);
imagesavealpha($image, true);

// 输出并销毁
Header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
