<?php
/*
 * index控制器大部分是aunt的方法
 */

namespace app\admin\controller;
use think\Controller;

use think\Db;
use app\admin\model\User;
use app\admin\model\Upload;
class Index extends Base
{

    public function index(){//管理员后端首页
        //统计数据
        $this -> view -> engine->layout('layout/admin_layout');//引入后端模板文件：layout/admin_layout
        $num['user']=Db::name( 'user')->count();
        $num['aunt']=Db::name( 'aunt')->count();
        $db=Db::name( 'count')->field('num')->select();


        $this -> assign('count',$db);
        $this -> assign('num',$num);
        return $this -> fetch('content');
    }

    public function aunt_list(){
        //todo管理员端显示阿姨列表
        $User = new User();
        $user_data = $User->getAuntList();

        //var_dump($user_data);
        $this -> view -> engine->layout('layout/admin_layout');//引入后端模板文件：layout/admin_layout
        $this -> assign('userlist',$user_data);
        return $this -> fetch('aunt_list');
    }
    public function aunt_detail(){//阿姨详情
        $this -> view -> engine->layout('layout/admin_layout');//引入后端模板文件：layout/admin_layout
        $User = new User();

        $userid = input('get.aunt_id');
        if($userid!=NULL){
            $aunt_data = $User -> getAuntDetail($userid);
            if($aunt_data!=NULL){
                $this -> assign('auntdetail',$aunt_data[0]);
                return $this -> fetch('aunt_detail');
            }else{
                $this->error('非法操作');//防止查不存在的阿姨
            }
        }else{
            $this->error('非法操作');//防止auntid为空
        }
    }
    public function aunt_delete(){
        if(!input('get.aunt_id')){
            return $this->error('非法操作');
        }
        $aunt_id = input('get.aunt_id');
        $User = new User();
        $rst = $User -> delAunt($aunt_id);
        if($rst==0){
            return $this->error('非法操作');
        }else{
            if($rst){
                return $this -> success("删除成功");
            }else{
                return $this -> error('删除失败');
            }
        }
    }
    public function aunt_mod(){
        $User = new User();
        if(!input('post.')){
            if(!input('get.aunt_id')){
                return $this -> error('非法操作');
            }
            $aunt_data =$User ->getAuntDetail(input('get.aunt_id'));
            $this -> view -> engine->layout('layout/admin_layout');//引入后端模板文件：layout/admin_layout
            $this -> assign('auntdetail',$aunt_data[0]);
            return $this->fetch('mod_aunt');
        }else{
            $data = input('post.');
            $rst = $User -> editAunt($data['id'],$data);
            if($rst==0){
                return $this->error('非法操作');
            }
            if($rst){
                return $this->success('修改成功','Index/aunt_list');
            }else{
                return $this->error('非法操作');
            }
        }
    }
}
