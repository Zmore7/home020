<?php

namespace app\index\controller;
use think\Controller;
use app\admin\model\Cate;
class Index extends Base
{
    //访问index

    public function index()
    {

        //获得用户信息
        if (session('username')!=0){
            $count=\think\Db::name('count')->field('num')->setInc('num',1);
        }
        $this -> view -> engine->layout('layout/layout1');
        return $this->fetch('index_m');
    }
    public function cate_list(){
        if(input('get.cat_id')){
            $Cate = new Cate();
            $data = $Cate -> getSecondCateDetail(input('get.cat_id'));//获取次级分类信息
            $m_data = $Cate -> getCateDetail(input('get.cat_id'));
            $this -> assign('maincatedata',$m_data[0]);//获得当前父级分类信息
            $this -> assign('catedata',$data);
            $this -> view -> engine->layout('layout/layout1');
            return $this->fetch('cate_list');
        }else{
            return $this -> error('非法操作');//传入空cat_id
        }

    }
    public function wrisess(){
        $data = input('session.');
        var_dump($data);
    }

}
