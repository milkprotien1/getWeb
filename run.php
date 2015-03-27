<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>生成信息</title>
    <style type="text/css">
        *{ padding: 0; margin: 0;font-family: '微软雅黑';color: #333;font-size: 16px;text-align:center }
        a{ font-size: 50px; font-weight: normal; line-height: 60px; margin-bottom: 12px; }
    </style>
</head>
<a href="index.html"> Σ( ° △ °|||)︴</a><br/>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/24
 * Time: 8:52
 */

include_once('GetWebClass.php');

$GetWeb=new GetWeb;
$config=['basicDir'=>$_GET['dir'],
    'weburl'=>$_GET['web'],];

$GetWeb->Go($config);

?>

