<?php
/**
 * Created by PhpStorm.
 * User: Floating-Two
 * Date: 2017/4/18
 * Time: 17:55
 */

namespace app\index\model;
use think\Model;
use think\Db;
use think\Upload;
class Uploader extends Model
{
    public function uploader($fileName='wangEditorH5File'){
        $config = [
            'maxSize'      => 2048000,
            'exts'         => ['jpg','gif','png','jpeg'],
            'autoSub'      => true,
            'subName'      => ['date', 'Y-m-d'],
            'rootPath'     => './data/',
            'savePath'     => 'attachement/',
            'saveExt'      => 'jpg',
            'hash'         => true,
            'callback'     => true,
            'driver'       => 'Local',
        ];
        $uploader = new Upload($config);
        $info = $uploader->upload();
        if(!$info){
            echo $uploader->getError();
        }else{
            header("Content-type:image/jpeg");
            echo '/data/'.$info[$fileName]['savepath'].$info[$fileName]['savename'];
        }
    }
}