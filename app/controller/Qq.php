<?php


namespace app\controller;

use think\facade\View;

use app\model\QqModel;

class Qq
{


    public function buy()
    {
        $id = $_GET['id'] ?? 0;
        $qqModel = QqModel::find($id);
        $price = $qqModel->price ?? 200;
        return redirect('http://www.tinygroup.cn/pay/index.php?price=' . $price);



    }


    public function six()
    {
        $model = new QqModel();
        $data = $model->where(['length' => 6])->where(['status' => 1])->select()->toArray();
        View::assign('data', $data);
        return View::fetch('qq');
    }

    public function seven()
    {
        $model = new QqModel();
        $data = $model->where(['length' => 7])->where(['status' => 1])->select()->toArray();
        View::assign('data', $data);
        return View::fetch('qq');
    }

    public function eight()
    {
        $model = new QqModel();
        $data = $model->where(['length' => 8])->where(['status' => 1])->select()->toArray();
        View::assign('data', $data);
        return View::fetch('qq');
    }

    public function nine()
    {
        $model = new QqModel();
        $data = $model->where(['length' => 9])->where(['status' => 1])->select()->toArray();
        View::assign('data', $data);
        return View::fetch('qq');
    }

    public function update()
    {
        //推荐整合
        //小程序版本
        //小黄鸭
        //app接口，按版本
        if ($_POST) {
            $post = $_POST;
            $id = $_POST['id'] ?? 0;
            $qqModel = QqModel::find($id);
            if(!$qqModel){
                $qqModel = new QqModel();
            }
            $qqModel->number = trim($post['number']);
            $qqModel->status = trim($post['status']);
            $qqModel->price = trim($post['price']);
            $qqModel->description = trim($post['description']);
            $qqModel->length = strlen($qqModel->number);
            $qqModel->create_time = time();
            $qqModel->update_time = time();

            if($qqModel->save()){
                return redirect('/qq/update.html?qq=' . $user->number);
            } else{

                echo '报错了';exit;
            }
        } else {
            $qq = $_GET['qq'] ?? 0;
            if ($qq) {
                $data = QqModel::where('number', $qq)->find()->toArray();
            } else {
                $data = [
                    'id' => 0,
                    'number'=>'',
                    'description' => '',
                    'status' => 1,
                    'price' => '',
                ];
            }
        }
        View::assign('data', $data);
        return View::fetch();
    }
}