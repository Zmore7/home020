<?php


namespace app\index\controller;

use think\Controller;
use think\Session;
use app\admin\model\User;
use app\index\model\Index;
class Aunt extends Base{
    public function aunt_center(){
        $auntdata = session('aunt_username');
        $check=\think\Db::name('aunt')->where('username','=',$auntdata)->select();
        if($check){
            var_dump($check);
            return $this->fetch('aunt_center');
        }else{
            return $this->error('未登录');
        }
    }
    public function aunt_detail(){
        //阿姨详情（用户访问的）
        if($id = input('id')){
            $db=\think\Db::name('aunt')->where('id','=',$id)->find();
            //var_dump($db);
            $this -> view -> engine->layout('layout/layout1');

            $this->assign('aunt',$db);
            return $this->fetch('aunt_detail');
        }

        return $this->error('没有参数');
    }
    public function order_detail()
    {
        $Index = new Index();
        $User = new User();
        if(request()->isPost()){
            var_dump(input('post.'));
            $data = input('post.');
            $rst = $Index -> InsertOrder($data);
            var_dump($rst);
        }else{
            if(input('get.aunt_id')){
                $this -> view -> engine->layout('layout/layout1');
                //获得阿姨详细信息
                $data = $User -> getAuntDetail(input('get.aunt_id'));
                var_dump($data);

                $this -> assign('aunt_detail',$data[0]);
                $this -> assign('aunt_catelist',$data['purpose_arr']);

                return $this->fetch('aunt_order');
            }else{
                return $this->error('非法操作');
            }
        }//todo 用户登录后的uid查询，订单中心，阿姨中心

    }
}