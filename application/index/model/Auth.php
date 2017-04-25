<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/4/22
 * Time: 21:11
 */

namespace app\index\model;


use think\Model;
use think\Db;
class Auth extends Model
{
    public function getUserInfo($username){
        //向session中进一步写入更多详细信息
        $db = Db::name('');
    }

}