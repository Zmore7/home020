<?php

namespace app\admin\controller;

use think\Controller;

use think\Db;
use app\admin\model\User;

class Huser extends Base
{
    public function user_list()
    {//用户列表

        $User = new User();
        $user_data = $User->getUserList();
        $this->view->engine->layout('layout/admin_layout');
        $this->assign('userlist', $user_data);
        return $this->fetch('user_list');
    }

    public function user_detail()
    {
        $this->view->engine->layout('layout/admin_layout');
        //引入后端模板文件：layout/admin_layout
        $User = new User();

        $userid = input('get.user_id');
        if ($userid != NULL) {
            $user_data = $User->getUserDetail($userid);
            if ($user_data != NULL) {
                $this->assign('userdetail', $user_data[0]);
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
        if (!input('get.user_id')) {
            return $this->error('非法操作');
        }
        $user_id = input('get.user_id');
        $User = new User();
        $rst = $User->delAunt($user_id);
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
            if (!input('get.user_id')) {
                return $this->error('非法操作');
            }
            $user_data = $User->getUserDetail(input('get.user_id'));
            $this->view->engine->layout('layout/admin_layout');
            //引入后端模板文件：layout/admin_layout
            $this->assign('userdetail', $user_data[0]);
            return $this->fetch('mod_user');
        } else {
            $data = input('post.');
            $rst = $User->editUser($data['id'], $data);
            if ($rst == 0) {
                return $this->error('非法操作');
            }
            if ($rst) {
                return $this->success('修改成功', 'User/user_list');
            } else {
                return $this->error('非法操作');
            }
        }
    }

    public function new_user()
    {
        if(request()->isPost()){
            //todo 验证没写，还有一个选项的完善
            $data = [
                'id' => input('id'),
                'username' => input('username'),
                'password' => md5(input('pass1')),//两次密码的验证放在前端验证

                'address' => input('address'),
                'name' => input('name'),
                'phone' => input('phone'),
                'money' => input('money'),
            ];
            //加入数据库
            $db = \think\Db::name('user')->insert($data);
            if ($db) {
                $this->success('注册成功', 'Huser/user_list');//注册成功应该跳转到登陆页面
            }
        }
        $this->view->engine->layout('layout/admin_layout');//引入模板
        return $this->fetch('new_user');

    }
}

