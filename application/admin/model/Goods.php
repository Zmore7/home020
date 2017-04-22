<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/4/22
 * Time: 20:09
 */

namespace app\admin\model;

use phpDocumentor\Reflection\Types\Null_;
use think\Model;
use think\Db;
class Goods extends Model
{
    public function getGoodsList(){
        $db = Db::name('goods')
            ->select();
        return $db;
    }
    public function delGoods($id){
        $db = $this->name('goods')
            ->where('goods_id','=',$id)
            ->select();
        if($db==NULL){
            return 0;
        }else{
            $db = Db::name('goods')
                ->where('goods_id','=',$id)
                ->delete();
            return $db;
        }

    }
}