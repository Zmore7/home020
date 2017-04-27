<?php

namespace app\index\controller;
use think\Controller;

class Index extends Base
{
    //访问index

    public function index()
    {
        //获得用户信息
        if (session('username')!=0){
            $count=\think\Db::name('count')->field('num')->setInc('num',1);
        }
        //var_dump($auntdata);var_dump($userdata);
        $this -> view -> engine->layout('layout/layout1');
        return $this->fetch('index_m');
    }
    public function cate_list(){
        $this -> view -> engine->layout('layout/layout1');
        return $this->fetch('cate_list');
    }
    public function wrisess(){
        $data = input('session.');
        var_dump($data);
    }

}
