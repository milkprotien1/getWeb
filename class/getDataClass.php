<?php
/**
 * 得到下载连接
 * User: Administrator
 * Date: 2015/3/23
 * Time: 10:57
 */
include_once('downLoadClass.php');
class getData extends downLoad
{

    /*
     * 处理原始数据得到有效文件名字
     * @in 1 web原始数据数组
     * @in 2 存放目录
     * @return array name数据
     * */
    public function getName($link, $Dir)
    {
        preg_match($this->namePattern, $link, $names);
        if (!empty($names)){
            if(preg_match('/\?/',$names[0])){
                $names[0]=str_replace('?','a',$names[0]);
            }
            return $Dir . $names[0];
        }
    }

    /*
    * 批量处理web原始数据得到文件名字和有效下载连接数组
    * @in 1 原始数据数组
    * @in 2 存放目录
    * @return  array （link,name,curl） 数组
    * */
    public function getL_N_C($allLink, $Dir)
    {
        $L_N_C = array();
        foreach ($allLink as $link) {
            $L_N_C[] = array($link, $this->getName($link, $Dir), $this->getWebcurl($link));
        }
        return $L_N_C;
    }

    //-------------------------web---------------------------------
    /*
     * 从web提出数据
     * 原始数据数组
     * @return array link原始数据
     * */
    public function getWeblink($str)
    {
        $data = array();
        foreach ($this->webPartern as $key => $val) {
            preg_match_all($val, $str, $result);
            $data[$key] = $result[1];
        }
        echo '<br/>得到web的原始url<br/>';
        return $this->weblink = $data;
    }


    /*
    * 处理web原始数据得到有效下载连接
    * @in 1 web原始数据数组
    * @return  curl数据
    * */
    public function getWebcurl($link)
    {
        if (substr($link, 0, 5) == 'http:') {
            if(preg_match('/\/.+&amp;.+\//', $link)){
                preg_match('/\/[^\/]+&amp;[^\/]+\//', $link, $names);
                $link=str_replace($names[0],'/',$link);
            }
            return $link;
        }elseif(substr($link, 0, 2) == '//'){
            return 'http:'.$link;
        }
        elseif (substr($link, 0, 1) == '/') {
            $url=parse_url($this->weburl);
            return  $url['scheme'].'://'.$url['host'] . $link;
            }
         else{
            return   $this->weburl.'/'.$link;
        }
    }


    /*
     * getWeb的起动能得到js，img，css的L_N_C，给webL_mane_curl属性赋值。
     * */
    public function getWebRun()
    {
        $this->getWeblink($this->webData);
        foreach($this->weblink as $kay=>$link){
                $this->webL_N_C[$kay]=$this->getL_N_C($link,$this->greateDir[$kay]);
        }
        return $this;
    }

}




