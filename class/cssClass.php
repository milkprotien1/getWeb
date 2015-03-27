<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/23
 * Time: 23:58
 */
include_once('greateClass.php');
class css extends greate {

    //css提取正则
    protected $cssPartern = <<<EOD
/url\(([^\(\)\"\']+?\.(png|gif|jpg|eot))/
EOD;

    //css的 link-name-curl 数组
    protected $cssL_N_C = array();
    //--------------------------------------------------------------------------


    /*
     * 下载css文件同时得到css中的有效的下载连接
     * */
    public function cssWebRun(){
        echo '<br/>下面生成css<br/>';
        foreach ($this->webL_N_C['link'] as $L_N_C ){
            $data=$this->downurl($L_N_C[2]);
            $this->cssL_N_C($L_N_C,$data);
            $data=$this->csshandle($data);
            $this->greateFile($L_N_C[1],$data);
        }
        return $this;
    }

    /*
     * getCss的起动下载css文件包含的东西
     * @
     * */
    public function cssDownRun(){
        echo '<br/>下载css文件包含的图片<br/>';
        $this->greateFloder($this->greateDir['link'] . '/resource');
        foreach ($this->cssL_N_C as $L_N_C){
            $this->greateFile( $L_N_C[1], $this->downurl($L_N_C[2]));
        }
    }
    /*
     * 处理css文件内容
     * @in 要处理的内容
     * @return 处理后的内容
     * */
    public function csshandle($data){

        foreach($this->cssL_N_C as $lnc){
            $name=substr($lnc[1],strlen($this->greateDir['link'])+1);//除去头的‘/’
            $data=str_replace($lnc[0], $name,$data);
        }
        return $data;
    }

    /*
     *得到cssL_N_C属性
     * @in 1  web 中css的L_N_C
     * @in 2  css的内容
     * */
    public function cssL_N_C($L_N_C,$data){
        $cssLC=$this->cssCurl($L_N_C,$data);
        if(!empty($cssLC)){
            foreach ($cssLC as $link => $curl) {
                $name = $this->getName($link, $this->greateDir['link'].'/resource');
                $this->cssL_N_C[] = array($link, $name, $curl);
            }
        }
    }

    /*
     * 给cssCurl属性赋值
     * */
    public function cssCurl($L_N_C,$data){

        if (substr($L_N_C[1],-4)=='.css'){
            preg_match($this->namePattern, $L_N_C[2], $names);
            $dtr=str_replace($names[0],'',$L_N_C[2]);
            preg_match('/\?.*$/', $dtr, $namess);
            if (!empty($namess)){
                $dtrs=str_replace($namess[0],'',$dtr);
            }else{
                $dtrs=$dtr;
            }

            return $this->cssGetCurl($data,$dtrs);
        }

    }

    /*
     * css提出数据
     * @return array link原始数据
     * */
    public function cssGetCurl($str, $cssdir)
    {
        preg_match_all($this->cssPartern, $str, $result);
        $data = array();
        foreach ($result[1] as $link) {
            if (substr($link, 0, 3) == '../') {
                $data[$link] = $this->dirUp($link, $cssdir);
            } elseif (substr($link, 0, 2) == '//') {
                $data[$link] = 'http:' . $link;
            }elseif(substr($link, 0, 1) == '/') {
                $url=parse_url($cssdir);
                $data[$link] = $url['scheme'].'://'.$url['host'] . $link;
            } elseif (substr($link, 0, 5) == 'http:') {
                $data[$link] = $link;
            }  else {
                $data[$link] = $cssdir . '/' . $link;
            }

        }

        return $data;
    }

    /*
    * 发现../的处理方法
    * @return  link处理后的方法
    * */
    public function dirUp($data, $dir)
    {
        $data = substr($data, 2);
        if (substr($dir, -1, 1) == '/') {
            $dir = substr($dir, 0, -2);
        }
        $partern = '/\/[^\/]+?$/';
        preg_match_all($partern, $dir, $a);
        $dir = str_replace($a[0], '', $dir);
        return $dir . $data;
    }





}