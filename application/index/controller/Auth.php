<?php
/**
 * Created by PhpStorm.
 * User: Floating-Two
 * Date: 2017/4/16
 * Time: 21:02
 * 包含月嫂的登录
 */

namespace app\index\controller;

use think\Controller;
use think\Upload;
use think\image;
use think\Session;
class Auth extends Controller
{
    public function login(){

        return $this->fetch('login_switch');
    }
    public function aunt_login()
{

    if (request()->isPost()) {
        $mima = input('password');
        $username = input('username');
        $password = md5($mima);

        //验证
        $validate = validate('User');
        //$result = $this->validate($_POST, 'User');
        $result = $validate->scene('login')->check($_POST);
        if (true !== $result) {
            // 验证失败 输出错误信息
            return $this->error($result);
        }

        $db = \think\Db::name('aunt')->where('username', '=', $username)->find();
        //var_dump($db);
        //var_dump($password);


        if ($db) {
            if ($db['password'] == $password) {
                //这是设置session的
                Session::set('aunt_username', $username);

                return $this->success('阿姨登陆成功', 'index/index');
            } else {
                return $this->error('密码错误');
            }
        }

    }
    return $this->fetch('aunt_login');
}

    public function user_login()//用户登录
    {

        if (request()->isPost()) {
            $mima = input('password');
            $username = input('username');
            $password = md5($mima);

            //验证
            $validate = validate('User');
            //$result = $this->validate($_POST, 'User');
            $result = $validate->scene('login')->check($_POST);
            if (true !== $result) {
                // 验证失败 输出错误信息
                return $this->error($result);
            }

            $db = \think\Db::name('user')->where('username', '=', $username)->find();
            //var_dump($db);
            //var_dump($password);


            if ($db) {
                if ($db['password'] == $password) {
                    //这是设置session的
                    Session::set('user_username', $username);

                    return $this->success('用户登陆成功', 'index/index');
                } else {
                    return $this->error('密码错误');
                }
            }

        }
        return $this->fetch('user_login');
    }


    public function signup()
    {

        //如果post数据了
        if (request()->isPost()) {
            $mima = input('pass1');
            $data = [
                'id' => input('id'),
                'username' => input('username'),
                'password' => md5($mima),//两次密码的验证放在前端验证
                'age' => input('age'),
                'address' => input('address'),
                'name' => input('name'),
                'phone' => input('phone'),
                'salary' => input('salary'),
            ];

            //验证内容
            $validate = validate('User');
            $result = $this->validate($_POST, 'User');
            if (true !== $result) {
                // 验证失败 输出错误信息
                return $this->error($result);
            }
            //todo 配合validate的图片上传以及对修改信息加入validate
            //添加到数据库
            $db = \think\Db::name('aunt')->insert($data);
            if ($db) {
                $this->success('注册成功', 'Auth/login');//注册成功应该跳转到登陆页面
            }
            //todo 文件上传无法实现
        }
        return $this->fetch('signup');
    }
    public function logout(){
        session::clear();
        return $this->success('注销成功');
    }
}