<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    //访问index

    public function index()
    {
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
