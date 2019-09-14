<?php
$text = "钢板卡号：4040 2333 114 514";
$image = imagecreatefrompng('v2ex_600721/images/bg.png');
$font = __DIR__ . '/v2ex_600721/fonts/mono.ttf';
imagecolortransparent($image, 0);
$white = imagecolorallocate($image, 255, 255, 255);
imagefttext($image, 12, 0, 36, 215, $white, $font, $text);
Header("Content-type: image/png");
imagepng($image);
