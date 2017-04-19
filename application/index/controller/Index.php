<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    //访问index

    public function index()
    {

        return $this->fetch('index');
    }
    public function wrisess(){
        $data = input('session.');
        var_dump($data);
    }

}
