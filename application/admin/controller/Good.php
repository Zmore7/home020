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
    public function goods_list(){//
        $Goods = new Goods();
        $data = $Goods -> getGoodsList();
        $this -> view -> engine->layout('layout/admin_layout');
        $this -> assign('goodslist',$data);
        return $this -> fetch('goods_list');
    }
    public function goods_delete(){
        $Goods = new Goods();
        if(request()->isPost()){
            $id = input('get.goods_id');
            $rst = $Goods -> delGoods($id);
            if ($rst){
                return $this->success('删除成功');
            }
            return $this->error('删除失败');
        }
        return $this->error('未传入参数','Good/goods_list');
    }
    public function goods_edit(){
        $Goods = new Goods();
        if (!input('post.')) {
            if (!input('get.user_id')) {
                return $this->error('非法操作');
            }
            $user_data = $Goods->getGoodsDetail(input('get.user_id'));
            $this->view->engine->layout('layout/admin_layout');
            //引入后端模板文件：layout/admin_layout
            $this->assign('goods_detail', $user_data[0]);
            return $this->fetch('goods_edit');
        } else {
            $data = input('post.');
            $rst = $Goods->editGoods($data['id'], $data);
            if ($rst == 0) {
                return $this->error('非法操作');
            }
            if ($rst) {
                return $this->success('修改成功', 'Good/goods_list');
            } else {
                return $this->error('非法操作');
            }
        }
    }
    public function goods_add(){
        $Goods = new Goods();
        if(input('post.')){

        }else{
            $this -> view -> engine->layout('layout/admin_layout');
            return $this -> fetch('goods_add');
        }
    }
}