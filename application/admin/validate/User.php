<?php

namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name' => 'require|max:25',
        'username' => 'require|max:10',
        'pass1' => 'alphaNum|min:6|max:16',
        'age' => 'number|between:1,100',
        'address' => 'require',
        'phone' => 'number',
        'salary' => 'number',
        'password'=> 'alphaNum|min:6|max:16',
    ];
    protected $message  =   [
        'username.require' => '用户名必须',
        'username.max'     => '用户名最多不能超过10个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-100之间',
        'phone.number'=>'电话号码必须是数字',
        'salary.number'=>'工资必须是数字',
        'password.min'=>'密码必须是数字和字母',
        'password.alphaNum'=>'密码必须是数字和字母',
        'pass1.alphaNum'=>'密码必须是数字和字母',
    ];
    protected $scene = [
        'login'  =>  ['username','password'],
    ];

}