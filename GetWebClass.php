<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/23
 * Time: 10:53
 */
namespace app\extensions\gerweb;
include_once('class/cssClass.php');
class GetWeb extends css{
    public function Go($config){
        foreach($config as $name => $val ){
            $this->$name=$val;
        }
        $this->downRun()->getWebRun()->handWebRun()->greateWebRun();
        $this->cssWebRun()->cssDownRun();
    }

}