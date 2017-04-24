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
}