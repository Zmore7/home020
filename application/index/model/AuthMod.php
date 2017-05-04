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
class AuthMod extends Model
{
    public function getUserInfo($username,$table){
        //向session中进一步写入更多详细信息 username查id
        $db = Db::name($table)
            ->where('username','=',$username)
            ->select();
        return $db[0];
    }

}