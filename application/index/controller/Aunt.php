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
            return $this->error('用户非阿姨或者未登录');
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
        if(session('aunt_id')!=NULL){
            return $this->error('您是阿姨，不可以下单','Index/Aunt/aunt_center');
        }else{
            $Index = new Index();
            $User = new User();
            if(request()->isPost()){
                var_dump(input('post.'));
                $data = input('post.');
                $data['uid'] = session('user_id');
                $rst = $Index -> InsertOrder($data);
                if($rst){
                    return $this -> success('订单添加成功，请等待阿姨与您联系~');
                }else{
                    return $this -> error('订单添加失败，请重试');
                }
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
}