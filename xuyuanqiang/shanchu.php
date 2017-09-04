<?php
header('content-type:text/html;charset=utf-8');

//引入用来存储文件的php文件
$re = include 'cunchuwenjian.php';

$x = $_GET['id'];


unset($re[$x]);

//将数组转成字符串形式
$configstr = var_export($re,true);
//组合要写入的内容
$str = "<?php\n\r return ".$configstr."\n\r ?>";
//将新的配置项写入到配置文件中
file_put_contents('cunchuwenjian.php',$str);


//跳转回当前许愿页面
echo '<script> location.href=\'index.php\' </script>';



















