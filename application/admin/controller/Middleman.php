<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/5/1
 * Time: 13:38
 */

namespace app\admin\controller;

use app\admin\model\Cate;
use app\admin\model\User;
class Middleman extends Base
{
    public function user_list()
    {//用户列表

        $User = new User();
        $user_data = $User->getMiddlemanList();
        $this->view->engine->layout('layout/admin_layout');
        $this->assign('userlist', $user_data);
        return $this->fetch('user_list');
    }
    public function user_detail()
    {
        $this->view->engine->layout('layout/admin_layout');
        //引入后端模板文件：layout/admin_layout
        $User = new User();

        $userid = input('get.mid_id');
        if ($userid != NULL) {
            $user_data = $User->getMiddlemanDetail($userid);
            $employee_list = $User -> getMiddlemanEmployee($userid);
            //var_dump($employee_list);
            if ($user_data != NULL) {
                $this->assign('userdetail', $user_data[0]);
                $this->assign('catelist', $user_data['category_str_arr']);
                $this->assign('employlist',$employee_list);
                //var_dump($user_data['category_str_arr']);
                return $this->fetch('user_detail');
            } else {
                $this->error('非法操作');//防止查不存在的用户
            }
        } else {
            $this->error('非法操作');//避免id为空
        }
    }
    public function user_delete()
    {
        if (!input('get.mid_id')) {
            return $this->error('非法操作');
        }
        $user_id = input('get.mid_id');
        $User = new User();
        $rst = $User->delMiddleman($user_id);
        if ($rst == 0) {
            return $this->error('非法操作');
        } else {
            if ($rst) {
                return $this->success("删除成功");
            } else {
                return $this->error('删除失败');
            }
        }
    }
    public function user_mod()
    {
        $User = new User();
        if (!input('post.')) {
            if (!input('get.mid_id')) {
                return $this->error('非法操作');
            }
            $user_data = $User->getMiddlemanDetail_Mid(input('get.mid_id'));//取得全部分类
            $this->view->engine->layout('layout/admin_layout');
            //引入后端模板文件：layout/admin_layout
            $this->assign('userdetail', $user_data[0]);
            $this->assign('catedetail', $user_data["category_str_arr"]);
            //var_dump($user_data);
            return $this->fetch('mod_user');
        } else {

            $data = input('post.');
            //var_dump($data);

            $rst = $User->editMiddleman($data['id'], $data);
            if ($rst == 0) {
                return $this->error('非法操作');
            }
            if ($rst) {
                return $this->success('修改成功', 'Admin/Middleman/user_list');
            } else {
                return $this->error('非法操作');
            }
        }
    }
    public function add_employee(){

    }
    public function add_middleman(){
        $User = new User();
        $Cate = new Cate();
            if(request()->isPost()){
                $rst = $User -> addMiddleman(input('post.'));
                if ($rst) {
                    return $this->success('添加成功', 'Admin/Middleman/user_list');
                } else {
                    return $this->error('添加失败');
                }
            }else{
                $this->view->engine->layout('layout/admin_layout');//引入模板
                $cate_list = $Cate -> getSecondCateDetail(9999);
                $this -> assign('secondlist',$cate_list);
                return $this->fetch('new_user');
            }

    }

}