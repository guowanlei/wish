<?php
header('content-type:text/html;charset=utf-8');


//设置时区
date_default_timezone_set('PRC');

$x = $_GET['id'];

//引入常用函数库
include 'functions.php';

//引入用来存储文件的php文件
$re = include 'cunchuwenjian.php';


if (isset($_GET['username'])&&isset($_GET['content'])) {

//          echo "<h2>{$_GET['username']}</h2>";
//          echo "<h2>{$_GET['content']}</h2>";

    //把用户传入的昵称和愿望数据 组成数组
    $arr=array('username'=>$_GET['username'],'content'=>$_GET['content'],'pic'=>$_GET['hide'],'time'=>date('y/m/d/h/i/s'));

   $re[$_GET['id']]=$arr;


    //将数组转成字符串形式
    $configstr = var_export($re,true);
    //组合要写入的内容s
    $str = "<?php\n\r return ".$configstr."\n\r ?>";
    //将新的配置项写入到配置文件中
    file_put_contents('cunchuwenjian.php',$str);

echo '<script> location.href=\'index.php\' </script>';

};



?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>HouDun许愿墙</title>
    <link rel="stylesheet" href="./Css/index.css" />
    <script type="text/javascript" src='./Js/jquery-1.7.2.min.js'></script>
    <script type="text/javascript" src='./Js/index.js'></script>
</head>
<body>

<div id='top'>
    <span id='send'></span>
</div>

<?php


echo "


<div id='send-form'   style='display: block;left: 50%;margin-left: -180px'>
    <p class='title'><span>重新许下你的愿望</span><a href='' id='close'></a></p>
    <form action=''   method='get'   name='wish'>
        <p>
            <label for='username'>昵称：</label>
            <input type='text' name='username' id='username' value='{$re[$x]['username']}'/>
            <input type='hidden' name='id' value=\"{$_GET['id']}\">
            </p>
            
            
        
        <p>
            <label for='content'>愿望：(您还可以输入&nbsp;<span id='font-num'>50</span>&nbsp;个字)</label>
            <textarea name='content' id='content'  > {$re[$x]['content']}</textarea>
        <div id='phiz'>
            <img src='./Images/phiz/zhuakuang.gif' alt='抓狂' />
            <img src='./Images/phiz/baobao.gif' alt='抱抱' />
            <img src='./Images/phiz/haixiu.gif' alt='害羞' />
            <img src='./Images/phiz/ku.gif' alt='酷' />
            <img src='./Images/phiz/xixi.gif' alt='嘻嘻' />
            <img src='./Images/phiz/taikaixin.gif' alt='太开心' />
            <img src='./Images/phiz/touxiao.gif' alt='偷笑' />
            <img src='./Images/phiz/qian.gif' alt='钱' />
            <img src='./Images/phiz/huaxin.gif' alt='花心' />
            <img src='./Images/phiz/jiyan.gif' alt='挤眼' />
        </div>
        </p>


        <label for='tijiao'><span id='send-btn'></span></label>
        <input   type='submit'  name='tijiao'  id='tijiao' style='display: none'  />
         <input type='hidden' name='hide'  value='{$re[$x]['pic']}' >
         

    </form>
</div>
"
?>
<!--[if IE 6]>
<script type="text/javascript" src="./Js/iepng.js"></script>
<script type="text/javascript">
    DD_belatedPNG.fix('#send,#close,.close','background');
</script>
<![endif]-->
</body>

</html>





















