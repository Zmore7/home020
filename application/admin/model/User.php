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
            $purpose_num = count($data['purpose']);
            $data['purpose'] = implode(",",$data['purpose']);
            $db = Db::name('aunt')
                ->where('id','=',$id)
                ->update($data);
            return $db;
        }
    }
    //用户的操作
    public function getUserList(){
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

    //admin的操作
    public function getAdminList(){
        $data = Db::name('admin')
            ->select();
        return $data;
    }
    public function getAdminDetail($id){
        $db = Db::name('admin')
            ->where('id','=',$id)
            ->select();
        return $db;
    }
    public function editAdmin($id,$data){
        $db = Db::name('admin')
            ->where('id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('admin')
                ->where('id','=',$id)
                ->update($data);
            return $db;
        }
    }
    public function delAdmin($id){
        $db = Db::name('admin')
            ->where('id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('admin')
                ->where('id','=',$id)
                ->delete();
            return $db;
        }
    }
    public function addAdmin($data){
        $data['created_time'] = date("Y:m:d H:i:s");
        $data['password'] = md5($data['password']);
        $db = Db::name('admin')
            ->insert($data);
        return $db;
    }
    public function addAunt($data){
        $data['created_time'] = date("Y:m:d H:i:s");
        $data['password'] = md5($data['password']);

        $purpose_num = count($data['purpose']);
        $data['purpose'] = implode(",",$data['purpose']);

        $db = Db::name('aunt')
            ->insert($data);
        return $db;
    }

}