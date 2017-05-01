<?php
/**
 * Created by PhpStorm.
 * User: GTX
 * Date: 2017/4/30
 * Time: 16:24
 */

namespace app\index\model;


use think\Model;
use think\Db;
class Buyer extends Model
{
    public function getAuntList($cat_id){
        //获取指定分类下的阿姨名单
        $db = Db::name('aunt')
            ->where('purpose','LIKE',"%".$cat_id."%")//
            ->select();
        $i = count($db);
        for($j = 0;$j < $i;$j++){
            $purpose_arr = explode(',',$db[$j]['purpose']);
            //var_dump($purpose_arr);
            $purpose_num = count($purpose_arr);

            for($k = 0;$k < $purpose_num;$k++){
                $db[$j]['purpose_str_arr'][$k] = Db::name('category')->where('cat_id','=',$purpose_arr[$k])->select();
                //var_dump($db[$j]['purpose_str_arr'][$k]);
            }
            //$db[$j]['purpose_str'] = implode(',',$db[$j]['purpose_str_arr'][0]);
        }
        //var_dump($db);
        return $db;
    }
}