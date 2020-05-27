<?php
header("Content-type: text/html; charset=utf-8");
require_once 'pay/model/builder/AlipayTradePrecreateContentBuilder.php';
require_once 'pay/service/AlipayTradeService.php';


$price = $_GET['price'] ?? 100;
// (必填) 商户网站订单系统中唯一订单号，64个字符以内，只能包含字母、数字、下划线，
// 需保证商户系统端不能重复，建议通过数据库sequence生成，
//$outTradeNo = "qrpay".date('Ymdhis').mt_rand(100,1000);
$outTradeNo = 'TD' . time() * 2 . mt_rand(10000, 99999);

// (必填) 订单标题，粗略描述用户的支付目的。如“xxx品牌xxx门店当面付扫码消费”
$subject = '扫码付款';

// (必填) 订单总金额，单位为元，不能超过1亿元
// 如果同时传入了【打折金额】,【不可打折金额】,【订单总金额】三者,则必须满足如下条件:【订单总金额】=【打折金额】+【不可打折金额】
$totalAmount = $price;
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
<html lang="zh-cn">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>alipay</title>
    <link type="text/css" rel="stylesheet" href="./css/style.css" />
</head>
<body style="min-width:990px;">
<div class="topbar">
    <div class="topbar-wrap fn-clear">
        <a href="https://help.alipay.com/lab/help_detail.htm?help_id=258086" class="topbar-link-last" target="_blank">常见问题</a>
        <span class="topbar-link-first">你好，欢迎使用支付宝付款！</span>
    </div>
</div>

<div id="header">
    <div class="header-container fn-clear">
        <div class="header-title">
            <div class="alipay-logo"></div>
            <span class="logo-title">我的收银台</span>
        </div>
    </div>
</div>

<div id="container">
    <div class="mi-notice mi-notice-success mi-notice-titleonly order-timeout-notice" id="J_orderPaySuccessNotice">
        <div class="mi-notice-cnt">
            <div class="mi-notice-title">
                <i class="iconfont" title="支付成功"></i>
                <h3>支付成功，<span class="ft-orange" id="J_countDownSecond">3</span> 秒后自动返回商户。</h3>
            </div>
        </div>
    </div>

    <div class="mi-notice mi-notice-error mi-notice-titleonly order-timeout-notice" id="J_orderDeadlineNotice">
        <div class="mi-notice-cnt">
            <div class="mi-notice-title">
                <i class="iconfont" title="交易超时"></i>

                <h3>抱歉，您的交易因超时已失败。</h3>

                <p class="mi-notice-explain-other">
                    您订单的最晚付款时间为： <span id="J_orderDeadline"></span>，目前已过期，交易关闭。
                </p>
            </div>
        </div>
    </div>

    <!-- 页面主体 -->
    <div id="content" class="fn-clear">

        <div id="J_order" class="order-area" data-module="excashier/login/2015.08.01/orderDetail">
            <div id="order" data-role="order" class="order order-bow">
                <div class="orderDetail-base" data-role="J_orderDetailBase">
                    <div class="order-extand-explain fn-clear">
                            <span class="fn-left explain-trigger-area order-type-navigator" style="cursor: auto" data-role="J_orderTypeQuestion">
                                <span>正在使用即时到账交易</span>
                                <span class="question-mark-hover" data-role="J_questionIcon" style="cursor: pointer;color: #08c;">[?]
                                    <div class="ui-tip ui-question-tip fn-hide" data-role="J_exchangeTip" style="left: 174px;top: 4px;">
                                        <div class="ui-dialog-container" style="width: 280px;">
                                            <ul class="ui-dialog-content">
                                                <li>
                                                    1、支付宝不收取任何货币兑换手续费。
                                                </li>
                                                <li>
                                                    2、最终支付金额为人民币金额，非外币金额。
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ui-icon-dialog-arrow">
                                            ↓
                                        </div>
                                    </div>
                                </span>
                            </span>
                    </div>
                    <div class="commodity-message-row">
                            <span class="first long-content">
                                QQ号购买:CFP202005261527443937
                            </span>
                        <span class="second short-content">
                                收款方：QQ号购买
                            </span>
                    </div>
                    <span class="payAmount-area" id="J_basePriceArea">
                            <strong class=" amount-font-22 "><?php echo $totalAmount?></strong> 元
                        </span>
                </div>

                <a id="J_OrderExtTrigger" class="order-ext-trigger">
                    订单详情
                </a>
            </div>
        </div>

        <!-- 操作区 -->
        <div class="cashier-center-container">

            <div data-module="excashier/login/2020.02.23/loginPwdMemberT" id="J_loginPwdMemberTModule" class="cashiser-switch-wrapper fn-clear">
                <!-- 扫码支付页面 -->
                <div class="cashier-center-view view-qrcode fn-left" id="J_view_qr">

                    <!-- 扫码区域 -->
                    <div data-role="qrPayArea" class="qrcode-integration qrcode-area" id="J_qrPayArea">
                        <div class="qrcode-header">
                            <div class="ft-center">扫一扫付款（元）</div>
                            <div class="ft-center qrcode-header-money"><?php echo $totalAmount?></strong></div>
                        </div>

                        <div data-role="qrPayCrash" class="qrcode-img-area qrcode-img-crash fn-hide">
                            <div class="qrcode-busy-icon">
                                <i class="iconfont qrpay-crash-icon"></i>
                            </div>
                            <p class="qrcode-busy-text ft-16">二维码太忙了,<br>请稍后再试</p>
                            <a href="https://excashier.alipay.com/standard/auth.htm?payOrderId=ec7809b421454893bdc17c60605eb04d.80#" class="mi-button mi-button-lwhite" data-role="qrPayRefreshBtn">
                                <span class="mi-button-text">重试</span>
                            </a>
                        </div>

                        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
                            <div data-role="qrPayImg" class="qrcode-img-area">
                                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">加载中</div>
                                <div style="position: relative;display: inline-block;">
                                    <canvas width="168" height="168" style="float: left;"></canvas>
                                    <img src="./pay.php?url=<?php echo $qr; ?>" alt="二维码" style="width: 100%;height: 100%;position: absolute;top: 0;left: 0;">
                                    <img src="./img/alipay-qrcode.png" style="display: none; position: absolute;top: 50%;left: 50%;width:42px;height:42px;margin-left: -21px;margin-top: -21px">
                                </div>
                            </div>

                            <div class="qrcode-img-explain fn-clear">
                                <img class="fn-left" src="./img/qrcode-scan.png" alt="扫一扫标识">
                                <div class="fn-left">打开手机支付宝<br>扫一扫继续付款</div>
                            </div>
                        </div>

                        <div class="qrcode-foot" data-role="qrPayFoot" style="display: block;">
                            <div data-role="qrPayExplain" class="qrcode-explain fn-hide" style="display: block;">
                                <a href="https://mobile.alipay.com/index.htm" class="qrcode-downloadApp" data-role="dl-app" target="_blank">首次使用请下载手机支付宝</a>
                            </div>

                            <div data-role="qrPayScanSuccess" class="mi-notice mi-notice-success mi-notice-titleonly qrcode-notice fn-hide">
                                <div class="mi-notice-cnt">
                                    <div class="mi-notice-title qrcode-notice-title">
                                        <i class="iconfont qrcode-notice-iconfont" title="扫描成功"></i>
                                        <p class="mi-notice-explain-other qrcode-notice-explain ft-break">
                                            <span class="ft-orange fn-mr5" data-role="qrPayAccount"></span>已创建订单，请在手机支付宝上完成付款
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 指引区域 -->
                    <div class="qrguide-area" id="J_qrguideArea">
                        <img src="./img/tips2.png" class="qrguide-area-img background">
                        <img src="./img/tips1.png" class="qrguide-area-img active" style="display: block;">
                    </div>
                </div>


                <!-- 点击切换区域 -->
                <div class="view-switch qrcode-show fn-left" style="display: block;" id="J_viewSwitcher" unselectable="on" onselectstart="return false;">

                    <div class="switch-tip switch-qrcode-tip " id="J_tip_qr">
                        <div class="switch-tip-font">&nbsp;</div>
                        <div class="switch-tip-icon-wrapper">
                            <i class="switch-tip-icon iconfont" title="显示器"></i>
                            <img class="switch-tip-icon-img" src="./img/alipay-icon.png" alt="支付宝图标" width="50" height="17">
                        </div>
                        <a class="switch-tip-btn" style="color: #FFF;" href="javascript:void(0)">&lt;&nbsp;扫一扫付款</a>
                    </div>

                    <div class="switch-tip switch-pc-tip fn-hide" id="J_tip_pc">
                        <div class="switch-tip-font">试试手机支付宝</div>
                        <div class="switch-tip-icon-wrapper">
                            <i class="switch-tip-icon iconfont" title="手机"></i>
                            <img class="switch-tip-icon-img" src="./img/alipay-qrcode.png" alt="手机支付宝图标" width="30" height="30">
                        </div>
                        <a class="switch-tip-btn" href="javascript:void(0)">扫一扫付款&nbsp;&gt;</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 操作区 结束 -->
    </div>
    <!-- 页面主体 结束 -->

    <div id="footer">
        <!-- FD:231:alipay/foot/copyright.vm:START -->
        <!-- FD:231:alipay/foot/copyright.vm:2604:foot/copyright.schema:支付宝copyright:START -->
        <div class="copyright">
        </div>
        <!-- FD:231:alipay/foot/copyright.vm:2604:foot/copyright.schema:支付宝copyright:END -->
        <!-- FD:231:alipay/foot/copyright.vm:END -->
    </div>
</div>

<div id="partner">
    <img alt="合作机构" src="./img/partner.png">
</div>
</body>
<!-- js start -->
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript">
    /*==============================================  变量定义  ==============================================*/
    var $qrguideAreaImg = $('.qrguide-area-img');

    /*==============================================  事件绑定  ==============================================*/

    // 切换提示图片
    var changeQrguide = {
        init: function(){
            changeQrguide.bingImgClick();
        },
        bingImgClick: function(){
            $qrguideAreaImg.on('click', function(){
                $(this).hide().siblings().show();
            })
        }
    }
    changeQrguide.init()
</script>
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
</html>
