<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/4/22
 * Time: 20:08
 */

namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\User;
use app\admin\model\Goods;

class Good extends Base
{
    public function show_list(){//
        $Goods = new Goods();
        $data = $Goods -> getGoodsList();
        $this -> view -> engine->layout('layout/admin_layout');
        $this -> assign('goodslist',$data);
        return $this -> fetch('goods_list');
    }
    public function goods_delete(){
        $Goods = new Goods();
        if(input('get.')){
            $id = input('get.good_id');
            $rst = $Goods -> delGoods($id);
            if($rst==0){
                return $this->error('服务不存在');
            }else{
                if($rst){
                    return $this->success('删除成功');
                }else{
                    return $this->error('删除失败');
                }
            }
        }else{
            return $this->error('非法参数');
        }
    }
    public function add_good(){
        $Goods = new Goods();
        if(input('post.')){

        }else{
            $this -> view -> engine->layout('layout/admin_layout');
            return $this -> fetch('goods_add');
        }
    }
}