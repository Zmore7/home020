<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/5/4
 * Time: 9:19
 */

namespace app\admin\controller;
use think\Controller;
use app\admin\model\OrderMod;
class Order extends Base
{
    public function order_list(){
        $Order = new OrderMod();
        $order_list = $Order -> getOrderList();
        $this -> assign('order_list',$order_list);
        $this->view->engine->layout('layout/admin_layout');
        return $this -> fetch('order_list');
    }
    public function show_detail(){
        $Order = new OrderMod();
        if(input('get.order_id')){
            $oid = input('get.order_id');
            $order_detail = $Order -> getOrderDetail($oid);
            //var_dump($order_detail);
            $this->view->engine->layout('layout/admin_layout');
            $this -> assign('order_detail',$order_detail[0]);
            $this -> assign('aunt_detail',$order_detail['aunt_detail']);
            return $this -> fetch('order_detail');
        }else{
            return $this->error('非法操作');
        }
    }
    public function order_mod(){
        $Order = new OrderMod();
        if(request()->isPost()){
            var_dump(input('post.'));
            $rst = $Order -> editOrderDetail(input('post.'));
            /*
            if($rst){
                return $this -> success('修改成功');
            }else{
                return $this -> error('修改失败');
            }*/
        }else{
            $order_data = $Order -> getOrderDetail(input('get.order_id'));
            $this->view->engine->layout('layout/admin_layout');
            $this -> assign('order_detail',$order_data[0]);
            return $this -> fetch('mod_order');
        }
    }
}