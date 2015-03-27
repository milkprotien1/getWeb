

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/23
 * Time: 11:00
 */
include_once('getDataClass.php');
class handle extends getData{


    /*
     * 处理index的内容，把连接改为本地
     * @in index的内容
     * @return 处理后的内容
     * */
    public function handIndex($indexData){
        foreach ($this->webL_N_C as $L_N_C){
            foreach($L_N_C as $lnc){
                if ($lnc[1]!=null){
                    $name=substr($lnc[1],1);//除去头的‘/’
                    $indexData=str_replace($lnc[0],$name,$indexData,$count);
                    if ($count>1){
                        echo " <p  style='color: gold'>处理 $name 超过2次，有产生错误的可能，请检查index.html是否有错误</p>";
                    }
                }
            }
        }
        return $indexData;
    }

    /*
     * 运行hand处理，得到webFileN_D属性、webCssfile属性
     * */
    public function handWebRun(){
        echo '<br/>处理index内容<br/>';
        $this->webData=$this->handIndex($this->webData);
        return $this;
    }


}