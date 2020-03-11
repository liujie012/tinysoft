<?php


namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\View;

class Pay extends BaseController
{
    public function alipay()
    {
        error_reporting(E_ERROR);
        $data = [
            'get' => ($_GET),
            'post' => ($_POST),
        ];
        $data = ['content' => json_encode($data), 'time' => time()];
        Db::name('alipay_test')->insert($data);

        if ($_POST['trade_status'] == 'TRADE_SUCCESS' || $_POST['trade_status'] == 'TRADE_FINISHED') {
            $no = $_POST['out_trade_no'];
            Db::table('apliay_order')->where('order_no', $no)->update(['status' => '1', 'update_time' => time()]);
            echo 'success';
        }

    }

    public function status()
    {
        $no = $_POST['no'] ?? '';
        $no = addslashes($no);
        if (!$no) {
            return json(['status' => 0, 'message' => 'no error']);
        }

        $order = Db::table('apliay_order')->where('order_no', $no)->find();
        if (!$order){
            return json(['status' => 0, 'message' => 'order error']);
        }
        if($order['status'] == 0) {
            return json(['status' => 0, 'message' => 'order status error']);
        }

        if ($order['status'] == 1) {
            return json(['status' => 1, 'message' => '', 'url' => 'http://www.tinygroup.cn/download.html']);
        }


    }
}