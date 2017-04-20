<?php

/**
 * Created by PhpStorm.
 * User: Floating-Two
 * Date: 2017/4/17
 * Time: 19:55
 * 大部分是aunt的方法！
 */
namespace app\admin\model;
use phpDocumentor\Reflection\Types\Null_;
use think\Model;
use think\Db;
class User extends Model
{


    public function getAuntList(){//获得阿姨列表
        $db = Db::name('aunt')->select();
        return $db;
    }
    public function getAuntDetail($id){
        $db = Db::name('aunt')
            ->where('id','=',$id)
            ->select();
        return $db;
    }
    public function delAunt($id){
        $db = Db::name('aunt')
            ->where('id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('aunt')
                ->where('id','=',$id)
                ->delete();
            return $db;
        }
    }
    public function editAunt($id,$data){
        $db = Db::name('aunt')
            ->where('id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('aunt')
                ->where('id','=',$id)
                ->update($data);
            return $db;
        }
    }
    public function getUserList(){//获取用户列表
        $db = Db::name('user')
            ->select();
        return $db;
    }
    public function getUserDetail($id){
        $db = Db::name('user')
            ->where('id','=',$id)
            ->select();
        return $db;
    }
    public function delUser($id){
        $db = Db::name('user')
            ->where('id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('user')
                ->where('id','=',$id)
                ->delete();
            return $db;
        }
    }
    public function editUser($id,$data){
        $db = Db::name('user')
            ->where('id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('user')
                ->where('id','=',$id)
                ->update($data);
            return $db;
        }
    }

    public function getAdminList(){
        $data = Db::name('admin')
            ->select();
        return $data;
    }
}