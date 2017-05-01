<?php


namespace app\index\controller;

use think\Controller;
use think\Session;

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
            var_dump($db);
            echo $db['name'];
            $this->assign('list',$db);
            return $this->fetch('aunt_detail');
        }

        return $this->error('没有参数');
    }
}