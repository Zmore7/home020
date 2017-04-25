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

    public function admin_mod()
    {//admin 可以修改的有username和password
        $User = new User();
        if(!input('post.')){
            //if(!input('get.admin_id')){
            //    return $this -> error('非法操作');
            //}
            //todo 被我注释掉了，问题是那个参数还是传递不了，最好的办法是把他写到控制器下，不当模板文件

            $aunt_data =$User ->getAdminDetail(input('get.admin_id'));
            $this -> view -> engine->layout('layout/admin_layout');//引入后端模板文件：layout/admin_layout
            $this -> assign('admindetail',$aunt_data[0]);
            return $this->fetch('mod_admin');
        }else{
            $data = input('post.');
            if($data['pass1']!=$data['pass2']){
                return $this->error('两次密码不一样');}
            else{

                $rst = $User -> editAdmin($data['id'],$data);
                if($rst==0){
                    return $this->error('用户不存在');
                }
                if($rst){
                    return $this->success('修改成功','Adminer/admin_list');
                }else{
                    return $this->error('非法操作');
                }
            }


        }
    }
    public function admin_delete(){
        if(!input('get.admin_id')){
            return $this->error('非法操作');
        }
        $admin_id = input('get.admin_id');
        $User = new User();
        $rst = $User -> delAdmin($admin_id);
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
    public function admin_add(){//添加管理员
        $User = new User();
        if(input('post.')){
            $data = input('post.');
            $rst = $User -> addAdmin($data);
            if($rst){
                return $this -> success("添加成功",'Admin/Adminer/admin_list');
            }else{
                return $this -> error('添加失败','Admin/Adminer/admin_list');
            }
        }else{
            $this -> view -> engine->layout('layout/admin_layout');//引入后端模板文件：layout/admin_layout
            return $this->fetch('add_admin');
        }
    }

}