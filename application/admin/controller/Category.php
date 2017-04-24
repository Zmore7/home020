<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/4/24
 * Time: 9:36
 */

namespace app\admin\controller;

use think\Controller;

use think\Db;
use app\admin\model\User;
use app\admin\model\Cate;
use app\admin\model\Upload;
class Category extends Base
{
    public function cate_list(){
        $Cate = new Cate();
        $data = $Cate -> getCateList();
        $this -> view -> engine->layout('layout/admin_layout');
        $this -> assign('catelist',$data);
        return $this -> fetch('cate_list');
    }
    public function add_cate(){
        $Cate = new Cate();
        if(input('post')){
            var_dump(input('post.'));
        }else{
            $data = $Cate -> getCateList();
            $this -> view -> engine->layout('layout/admin_layout');
            $this -> assign('catelist',$data);
            return $this -> fetch('add_cate');
        }
    }
}