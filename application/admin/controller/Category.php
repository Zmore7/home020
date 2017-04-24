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
        $data_p = $Cate -> getCateList(0);
        $data_s = $Cate -> getCateList(1);
        $data_big = $Cate -> getServNumber();
        $this -> view -> engine->layout('layout/admin_layout');
        $this -> assign('catelist_p',$data_p);
        $this -> assign('catelist_s',$data_s);
        return $this -> fetch('cate_list');
    }
    public function cate_add(){
        $Cate = new Cate();
        if(input('post.')){
            //var_dump(input('post.'));
            $data = input('post.');
            //var_dump($data);
            $rst = $Cate -> addCate($data);
            if($rst){
                return $this->success('增加分类成功','Category/cate_list');
            }else{
                return $this->error('增加分类失败');
            }
        }else{
            $data = $Cate -> getCateList(0);
            $this -> view -> engine->layout('layout/admin_layout');
            $this -> assign('catelist',$data);
            return $this -> fetch('cate_add');
        }
    }
    public function cate_del(){
        if(input('get.')) {
            $Cate = new Cate();
            $rst = $Cate->delCate(input('get.cate_id'));
            if ($rst == 0) {
                return $this->error('分类不存在');
            } else {
                if($rst){
                    return $this->success('删除分类成功');
                }else{
                    return $this->error('删除分类失败');
                }
            }
        }
    }
    public function cate_mod(){
        $Cate = new Cate();

            if(input('post.')){
                //var_dump(input('post.'));
                $data = input('post.');
                $rst = $Cate -> editCate($data['cat_id'],$data);
                if ($rst == 0) {
                    return $this->error('分类不存在','Admin/Category/cate_list');
                } else {
                    if($rst){
                        return $this->success('修改分类成功','Admin/Category/cate_list');
                    }else{
                        return $this->error('修改分类失败','Admin/Category/cate_list');
                    }
                }
            }else{
                $data = $Cate -> getCateDetail(input('get.cate_id'));
                $this -> view -> engine->layout('layout/admin_layout');
                $this -> assign('catedetail',$data[0]);
                return $this -> fetch('mod_cate');
            }


    }
}