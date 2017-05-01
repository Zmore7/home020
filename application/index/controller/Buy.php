<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/4/30
 * Time: 16:21
 */

namespace app\index\controller;

use app\admin\model\Cate;
use app\index\model\Buyer;
class Buy extends Base
{
    public function buylist(){//查寻指定分类的家政人员
        $Cate = new Cate();
        $Buyer = new Buyer();
        if(input('get.cat_id')){
            $maincatedata = $Cate -> getCateDetail(input('get.cat_id'));//获得父级分类信息
            $this -> assign('maincatedata',$maincatedata);
            //var_dump($maincatedata);
            $auntlist = $Buyer -> getAuntList(input('get.cat_id'));
            //var_dump($auntlist);
            $this -> assign ('auntlist',$auntlist);
            $this -> view -> engine->layout('layout/layout1');
            return $this -> fetch('aunt_list');

        }else{

            return $this -> error('非法操作');
        }
    }
}