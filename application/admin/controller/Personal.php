<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\model\User;

class Personal extends Base{
    public function index(){
        $User = new User();
        $id=session('id');
        $db =$User ->getAdminDetail($id);

    }
}
