<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/5/4
 * Time: 9:20
 */

namespace app\admin\model;
use think\Model;
use think\Db;

class OrderMod extends Model
{
    public function getOrderList(){
        $db = Db::name('order')
            ->select();
        return $db;
    }
    public function getOrderDetail($oid)
    {
        $db = Db::name('order')
            ->where('id', '=', $oid)
            ->select();
        //获取阿姨相应信息
        $db['aunt_detail'] = Db::name('aunt')->where('id', '=', $db[0]['aunt_id'])->select();

        return $db;
    }
    public function editOrderDetail($data){
        $db = Db::name('order')
            ->where('id','=',(int)($data['id']))
            ->update($data);
        var_dump($db);
    }
}