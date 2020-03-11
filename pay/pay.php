<?php


function scerweima2($url = '')
{
    require_once './phpqrcode/phpqrcode.php';
    $value = $url;         //二维码内容
    $errorCorrectionLevel = 'L';  //容错级别
    $matrixPointSize = 7;      //生成图片大小
    //生成二维码图片
    $QR = QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize, 2);
}

$url = $_GET['url'];
$url = base64_decode($url);

//调用查看结果
scerweima2($url);