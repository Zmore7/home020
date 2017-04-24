<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/4/24
 * Time: 9:37
 */

namespace app\admin\model;


use think\Model;
use think\Db;
class Cate extends Model
{
    public function getCateList(){
        $db = Db::name('category')
            ->select();
        return $db;
    }
    public function addCate($data){
        $data['created_time'] = date("Y:m:d H:i:s");
        if($data['parent_id']==9999){
            $data['cat_level']=0;
        }else{
            //目前只做到二级分类（0、1、2级）
            $level = Db::name('category')
                ->where('cat_id','=',$data['parent_id'])
                ->select();
            if($level[0]['cat_level']==0){
                $data['cat_level'] = 1;
            }else{
                $data['cat_level'] = 2;
            }
        }
        $db = Db::name('category')
            ->insert($data);
        return $db;
    }
    public function delCate($id){//注意连带删除！
        $ext = Db::name('category')
            ->where('cat_id','=',$id)
            ->select();
        if($ext==NULL){
            return 0;
        }else{
            $db = Db::name('category')//本分类下的子分类的删除
                ->where('parent_id','=',$id)
                ->delete();
            $db = Db::name('category')//本分类下的子分类的删除
                ->where('cat_id','=',$id)
                ->delete();
        }
        return $db;
    }
}