<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/23
 * Time: 10:55
 */

class downLoad {

    //下载目录
    public $basicDir;
    //要下载的网站地址
    public $weburl;
    //要生成的文件夹
    public $greateDir = array(
            'link' => '/link',
            'js' => '/js',
            'img' => '/img',
        );
    //--------------------------------------------------------
    //wed提取正则
    protected $webPartern = array(
        'link' => '/<link.*?href="(.*?)".*?>/',
        'img' => '/<img.*?src="(.*?)".*?>/',
        'js' => '/<script.*?src="(.*?)".*?>/',
    );
    //文件名提取正则
    protected $namePattern = '/\/[^\/]+\.(css|js|jpg|png|gif|ico|src)/';
    //-----------------------------------
    protected $webData='';//index.html文件内容
    protected $weblink=array();//web文件提取出的原始数据
    protected $webL_N_C=array();//文件提取出的link-name-curl数组
    //-----------------------------------

    //-------------------------------------

    /*
     * 下载curl数据
     * @in    网站连接
     * @return string webdata
     * */
    public function downurl($url){
        $ch = curl_init ( ) ;
        // 2. 设置选项，包括URL
        curl_setopt ( $ch , CURLOPT_URL, $url ) ;
        curl_setopt ( $ch , CURLOPT_RETURNTRANSFER, 1 ) ;
        curl_setopt ( $ch , CURLOPT_HEADER, 0 ) ;
        // 3. 执行并获取HTML文档内容
        if(!($downdata = curl_exec ( $ch ))){
           echo  "<p  style='color: firebrick'>curl获取 $url 数据失败,(￣ε(#￣)☆╰╮o(￣皿￣///)警告：后面可能会出现各种错误！</p><br/>";
        }
        // 4. 释放curl句柄
        curl_close ( $ch ) ;
        return $downdata;
    }

    /*
     * 批量下载curl数据
     * @in    array curl
     * @return array string webdata
     * */
    public function downallurl($allUrl){
        foreach($allUrl as $url){
            $downalldata[]=$this->downurl($url);
        }
        return $downalldata;
    }
    /*
     * 下载index.html的内容，配置webData属性
     *
     * */
    public function downRun(){
        $this->webData=$this->downurl($this->weburl);
        echo '<br/>下载index.html的内容.....<br/>';
        return $this;
    }

}