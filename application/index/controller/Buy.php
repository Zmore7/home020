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
        if(input('get.cat_id')){

            $this -> view -> engine->layout('layout/layout1');
            return $this -> fetch('ayi_list');

        }else{

            return $this -> error('非法操作');
        }
    }
}