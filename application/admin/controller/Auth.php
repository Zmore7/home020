<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/4/24
 * Time: 9:25
 * admin登录验证
 */

namespace app\admin\controller;
use think\Controller;
use think\Upload;
use think\image;
use think\Session;

class Auth extends Controller
{
    public function login()
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

            $db = \think\Db::name('admin')->where('username', '=', $username)->find();
            //var_dump($db);
            //var_dump($password);


            if ($db) {
                if ($db['password'] == $password) {
                    //这是设置session的
                    Session::set('username', $username);

                    return $this->success('登陆成功', 'index/index');
                } else {
                    return $this->error('密码错误');
                }
            }

        }
        return $this->fetch('login');
    }
    /*管理员不允许注册
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
            $db = \think\Db::name('admin')->insert($data);
            if ($db) {
                $this->success('注册成功', 'Auth/login');//注册成功应该跳转到登陆页面
            }
            //todo 文件上传无法实现
        }
        return $this->fetch('signup');
    }*/
    public function logout(){
        session::clear();
        return $this->success('注销成功', 'Auth/login');
    }
}