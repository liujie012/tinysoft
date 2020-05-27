<?php
header("Content-type: text/html; charset=utf-8");
require_once 'pay/model/builder/AlipayTradePrecreateContentBuilder.php';
require_once 'pay/service/AlipayTradeService.php';

// (必填) 商户网站订单系统中唯一订单号，64个字符以内，只能包含字母、数字、下划线，
// 需保证商户系统端不能重复，建议通过数据库sequence生成，
//$outTradeNo = "qrpay".date('Ymdhis').mt_rand(100,1000);
$outTradeNo = 'TD' . time() * 2 . mt_rand(10000, 99999);

// (必填) 订单标题，粗略描述用户的支付目的。如“xxx品牌xxx门店当面付扫码消费”
$subject = '扫码付款';

// (必填) 订单总金额，单位为元，不能超过1亿元
// 如果同时传入了【打折金额】,【不可打折金额】,【订单总金额】三者,则必须满足如下条件:【订单总金额】=【打折金额】+【不可打折金额】
$totalAmount = 10;
//$totalAmount = 0.22;
// (不推荐使用) 订单可打折金额，可以配合商家平台配置折扣活动，如果订单部分商品参与打折，可以将部分商品总价填写至此字段，默认全部商品可打折
// 如果该值未传入,但传入了【订单总金额】,【不可打折金额】 则该值默认为【订单总金额】- 【不可打折金额】
//String discountableAmount = "1.00"; //

// (可选) 订单不可打折金额，可以配合商家平台配置折扣活动，如果酒水不参与打折，则将对应金额填写至此字段
// 如果该值未传入,但传入了【订单总金额】,【打折金额】,则该值默认为【订单总金额】-【打折金额】
//$undiscountableAmount = "0.01";

// 卖家支付宝账号ID，用于支持一个签约账号下支持打款到不同的收款账号，(打款到sellerId对应的支付宝账号)
// 如果该字段为空，则默认为与支付宝签约的商户的PID，也就是appid对应的PID
//$sellerId = "";

// 订单描述，可以对交易或商品进行一个详细地描述，比如填写"购买商品2件共15.00元"
$body = "购买商品1件共{$totalAmount}元";

//商户操作员编号，添加此参数可以为商户操作员做销售统计
$operatorId = "test_operator_id";

// (可选) 商户门店编号，通过门店号和商家后台可以配置精准到门店的折扣信息，详询支付宝技术支持
$storeId = "1234511";

// 支付宝的店铺编号
$alipayStoreId = "test_alipay_store_id";

// 业务扩展参数，目前可添加由支付宝分配的系统商编号(通过setSysServiceProviderId方法)，系统商开发使用,详情请咨询支付宝技术支持
$providerId = ""; //系统商pid,作为系统商返佣数据提取的依据
$extendParams = new ExtendParams();
$extendParams->setSysServiceProviderId($providerId);
$extendParamsArr = $extendParams->getExtendParams();

// 支付超时，线下扫码交易定义为5分钟
$timeExpress = "60m";

// 商品明细列表，需填写购买商品详细信息，
$goodsDetailList = array();

// 创建一个商品信息，参数含义分别为商品id（使用国标）、名称、单价（单位为分）、数量，如果需要添加商品类别，详见GoodsDetail
$goods1 = new GoodsDetail();
$goods1->setGoodsId("goods-01");
$goods1->setGoodsName("商品01");
$goods1->setPrice($totalAmount * 100);
$goods1->setQuantity(1);
//得到商品1明细数组
$goods1Arr = $goods1->getGoodsDetail();

//    // 继续创建并添加第一条商品信息，用户购买的产品为“xx牙刷”，单价为5.05元，购买了两件
//    $goods2 = new GoodsDetail();
//    $goods2->setGoodsId("apple-02");
//    $goods2->setGoodsName("ipad");
//    $goods2->setPrice(1000);
//    $goods2->setQuantity(1);
//    //得到商品1明细数组
//    $goods2Arr = $goods2->getGoodsDetail();

//$goodsDetailList = array($goods1Arr, $goods2Arr);

$goodsDetailList = [$goods1Arr];

//第三方应用授权令牌,商户授权系统商开发模式下使用
$appAuthToken = "";//根据真实值填写

// 创建请求builder，设置请求参数
$qrPayRequestBuilder = new AlipayTradePrecreateContentBuilder();
$qrPayRequestBuilder->setOutTradeNo($outTradeNo);
$qrPayRequestBuilder->setTotalAmount($totalAmount);
$qrPayRequestBuilder->setTimeExpress($timeExpress);
$qrPayRequestBuilder->setSubject($subject);
$qrPayRequestBuilder->setBody($body);
//$qrPayRequestBuilder->setUndiscountableAmount($undiscountableAmount);
$qrPayRequestBuilder->setExtendParams($extendParamsArr);
$qrPayRequestBuilder->setGoodsDetailList($goodsDetailList);
//$qrPayRequestBuilder->setStoreId($storeId);
//$qrPayRequestBuilder->setOperatorId($operatorId);
//$qrPayRequestBuilder->setAlipayStoreId($alipayStoreId);

$qrPayRequestBuilder->setAppAuthToken($appAuthToken);


// 调用qrPay方法获取当面付应答
$qrPay = new AlipayTradeService($config);
$qrPayResult = $qrPay->qrPay($qrPayRequestBuilder);

//	根据状态值进行业务处理
$qr = '';
$out_trade_no = '';
switch ($qrPayResult->getTradeStatus()) {
    case "SUCCESS":
        // echo "支付宝创建订单二维码成功:" . "<br>---------------------------------------<br>";
        $response = $qrPayResult->getResponse();
        $qr = $response->qr_code ?? '';
        $out_trade_no = $response->out_trade_no ?? '';
//			$qrcode = $qrPay->create_erweima($response->qr_code);
//			echo $qrcode;
        //print_r($response);

        $servername = "qdm70682163.my3w.com";
        $username = "qdm70682163";
        $password = "Hello123456";
        $dbname = "qdm70682163_db";

        // 创建连接
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        $time = time();
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO apliay_order (order_no, amount, create_time, create_date) VALUES ('$outTradeNo', $totalAmount, $time, '$date')";

        if ($conn->query($sql) === TRUE) {
            //echo "新记录插入成功";
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        //exit;
        break;
    case "FAILED":
        echo "支付宝创建订单二维码失败!!!" . "<br>--------------------------<br>";
        if (!empty($qrPayResult->getResponse())) {
            //print_r($qrPayResult->getResponse());
        }
        return;
    case "UNKNOWN":
        echo "系统异常，状态未知!!!" . "<br>--------------------------<br>";
        if (!empty($qrPayResult->getResponse())) {
            //print_r($qrPayResult->getResponse());
        }
        return;
    default:
        echo "不支持的返回状态，创建订单二维码返回异常!!!";
        break;
}
$qr = base64_encode($qr);

?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>支付助手</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <style>
        .qr-code {
            margin: 10% 0 0 40%;
        }
    </style>
</head>
<body>
<div class="content-container qr-code">
    <h3>支付宝付款：￥<?php echo $totalAmount; ?>后下载</h3>
    <img src="./pay.php?url=<?php echo $qr; ?>">
</div>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

<script>
    var no = '<?php echo $out_trade_no;?>';

    function check() {
        var url = '/pay/status?v=' + Math.ceil(Math.random() * 1000)
        $.post(url, {no: no}, function (data) {
            if (data && data.status == 1) {
                window.location.href = data.url
                return;
            }
        }, 'json');
    }

    var int = self.setInterval("check()", 5000);
</script>

</body>
</html>
