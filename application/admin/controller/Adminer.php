<?php
/**
 * Created by PhpStorm.
 * User: Floating-Two
 * Date: 2017/4/19
 * Time: 21:00
 * 主要是管理员的CURD
 */

namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\User;

class Adminer extends Base
{
    public function admin_list(){
        $User = new User();
        $data = $User->getAdminList();
        $this -> view -> engine->layout('layout/admin_layout');
        $this -> assign('adminlist',$data);
        return $this -> fetch('admin_list');
    }
}