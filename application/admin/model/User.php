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

        $purpose_arr = explode(',',$db[0]['purpose']);
        $purpose_num = count($purpose_arr);
        for($i = 0;$i < $purpose_num;$i++){
            $temp = Db::name('category')
                ->field('cat_name')
                ->where('cat_id','=',$purpose_arr[$i])
                ->select();
            //var_dump($temp);
            $purpose_arr[$i] = $temp[0]['cat_name'];
        }
        $db['purpose_arr'] = $purpose_arr;
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
    //经纪人操作
    public function getMiddlemanList(){
        $db = Db::name('middleman')
            ->select();
        return $db;
    }
    public function getMiddlemanDetail($id){
        $db = Db::name('middleman')
            ->where('id','=',$id)
            ->select();
        $category_arr = explode(',',$db[0]['category']);
        //var_dump($category_arr);
        $arr_num = count($category_arr);
        $category_str_arr = array();
        for($i = 0;$i < $arr_num;$i++){
            $category_str_arr[$i] = Db::name('category')->where('cat_id','=',$category_arr[$i])->select();
        }
        //var_dump($category_str_arr);
        $db['category_str_arr'] = $category_str_arr;
        //var_dump($db);
        return $db;
    }
    public function getMiddlemanDetail_Mid($id){
        $db = Db::name('middleman')
            ->where('id','=',$id)
            ->select();
        $category_arr = explode(',',$db[0]['category']);
        //var_dump($category_arr);
        $arr_num = count($category_arr);
        $category_str_arr = array();
        $category_str_arr = Db::name('category')
            ->select();
        //var_dump($category_str_arr);
        $db['category_str_arr'] = $category_str_arr;
        //var_dump($db);
        return $db;
    }
    public function getMiddlemanEmployee($mid){
        $db = Db::name('aunt')
            ->where('mid','=',$mid)
            ->select();
        $employee_num = count($db);
        $category_arr_str = "";
        for($i = 0;$i < $employee_num;$i++){
            $category_arr = explode(',',$db[$i]['purpose']);
            $purpose_num = count($category_arr);
            for($j = 0;$j < $purpose_num;$j++){
                $temp = Db::name('category')->field('cat_name')->where('cat_id','=',$category_arr[$j])->select();
                //var_dump($temp);
                $category_arr[$j] = $temp;
                //var_dump($category_arr);
            }
            $db[$i]['cat_name_arr'] = $category_arr;
            //var_dump($db[$i]['cat_name_arr']);
        }
        return $db;
    }
    public function delMiddleman($id){
        $db = Db::name('middleman')
            ->where('id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('middleman')
                ->where('id','=',$id)
                ->delete();
            return $db;
        }
    }
    public function editMiddleman($id,$data){
        $data['category'] = implode(',',$data['category']);
        $db = Db::name('middleman')
            ->where('id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('middleman')
                ->where('id','=',$id)
                ->update($data);
            return $db;
        }
    }
    public function addMiddleman($data){
        $data['category'] = implode(',',$data['category']);
        $data['password'] = md5($data['password']);
        $db = Db::name('middleman')
            ->insert($data);
        return $db;
    }
    public function getMiddlemanAppliedEmployee($mid){
        $db = Db::name('aunt')
            ->where('apply_mid','=',$mid)
            ->select();
        $employee_num = count($db);
        $category_arr_str = "";
        for($i = 0;$i < $employee_num;$i++){
            $category_arr = explode(',',$db[$i]['purpose']);
            $purpose_num = count($category_arr);
            for($j = 0;$j < $purpose_num;$j++){
                $temp = Db::name('category')->field('cat_name')->where('cat_id','=',$category_arr[$j])->select();
                //var_dump($temp);
                $category_arr[$j] = $temp;
                //var_dump($category_arr);
            }
            $db[$i]['cat_name_arr'] = $category_arr;
            //var_dump($db[$i]['cat_name_arr']);
        }
        return $db;
    }
    public function accept_employee($id,$mid,$accept){//accept=1为接受、0为不接受、2为删除
        if($accept==1){
            $db = Db::name('aunt')
                ->where('id','=',$id)
                ->update(['mid'=>$mid,'apply_mid'=>0]);
            $emloyee_num = Db::name('middleman')
                ->field('employee_num')
                ->where('id','=',$mid)
                ->select();
            $db = Db::name('middleman')
                ->where('id','=',$mid)
                ->update(['employee_num' => ($emloyee_num[0]["employee_num"]+1)]);
            return $db;
        }else if($accept==0){
            $db = Db::name('aunt')
                ->where('id','=',$id)
                ->update(['mid'=>0,'apply_mid'=>3]);//3代表被拒绝
            return $db;
        }else if($accept==2){
            $db = Db::name('aunt')
                ->where('id','=',$id)
                ->update(['mid'=>0,'apply_mid'=>0]);
            $emloyee_num = Db::name('middleman')
                ->field('employee_num')
                ->where('id','=',$mid)
                ->select();
            $db = Db::name('middleman')
                ->where('id','=',$mid)
                ->update(['employee_num' => ($emloyee_num[0]["employee_num"]-1)]);
            return $db;
        }else{
            return 0;
        }
    }

}