<?php
/**
 * Created by PhpStorm.
 */
include_once('handleClass.php');
class greate extends handle{


    //-------------------------文件夹---------------------------

    /*
     * 文件夹生成
     * @in   string: 路径/文件夹名
     * */
    public function greateFloder($dir=''){

        if (file_exists($this->basicDir.$dir))
            echo "文件夹\" $dir \"已经存在（⊙＿⊙；）<br/>";
        else {
            if (mkdir($this->basicDir.$dir,'0777',true))
                echo "[]~(￣▽￣)~*创建文件夹\" $dir \"<br/>";
            else echo "<p  style='color: firebrick'>\" $dir \"创建失败<br/></p>";
        }
    }

    /*
    * 批量文件夹生成
    * @in   array string: 路径/文件夹名
    * */
    public function greateAllFloder($alldir){
        foreach ($alldir as $dir){
            $this->greateFloder($dir);
        }
    }

    //---------------------------文件-----------------------------------

    /*
    * 文件生成
    * @in 1  文件夹名
    * @in 2  写入内容
    * */
    public function greateFile($name,$data){
        $dir=$this->basicDir.$name;
        if($name!= null) {
            if ($filebit = file_put_contents($dir, $data))
                echo '生成' . $name . '(>▽<)成功！(大小为' . number_format($filebit / 1024, 2) . 'kb)<br/>';
            else
                echo "<p  style='color: firebrick'>生成'  $name  '(；′⌒`)失败！</p>";
        }else echo '不是所需文件！╮(╯▽╰)╭<br/>';
    }

    /*
    * 批量文件生成
    * @in   array string:
    * */
    public function greateAllFile($nameStr){
        foreach($this->webL_N_C[$nameStr] as $LNC){
            $this->greateFile($LNC[1], $this->downurl($LNC[2]));
        }
    }

    /*
     * 运行生成文件夹，web的js、img有文件
     * */
    public function greateWebRun(){
        $this->greateFloder();
        $this->greateFile('/index.html',$this->webData);
        $this->greateAllFloder($this->greateDir);
        echo '<br/>生成js文件<br/>';
        $this->greateAllFile('js');
        echo '<br/>生成图片文件<br/>';
        $this->greateAllFile('img');

    }
}