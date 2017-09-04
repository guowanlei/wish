

<?php
header('content-type:text/html;charset=utf-8');

//设置时区
date_default_timezone_set('PRC');


if (isset($_FILES['pic'])){

//获得上传头像文件的详情
$pinfo = pathinfo($_FILES['pic']['name']);


//创建要移动到的位置和文件名
$tofile = 'uploads/'.time().'.'.$pinfo['extension'];

//将临时文件挪到指定的目录
move_uploaded_file($_FILES['pic']['tmp_name'],$tofile);


};



         //引入常用函数库
           include 'functions.php';

       //引入用来存储文件的php文件
           $re = include 'cunchuwenjian.php';

       //用GET方式获得表单传入的用户昵称和愿望内容
       //判断昵称和愿望内容是否存在
          if (isset($_POST['username'])&&isset($_POST['content'])&&isset($_FILES['pic'])){
//          echo "<h2>{$_GET['username']}</h2>";
//          echo "<h2>{$_GET['content']}</h2>";

          //把用户传入的昵称和愿望数据 组成数组
         $arr=array('username'=>$_POST['username'],'content'=>$_POST['content'],'pic'=>$tofile,'time'=>date('y/m/d/h/i/s'));

              //调用C函数  把$arr数组数据与源文件数组合并
             $re=C($re,$arr);


          //将数组转成字符串形式
          $configstr = var_export($re,true);
          //组合要写入的内容
          $str = "<?php\n\r return ".$configstr."\n\r ?>";
          //将新的配置项写入到配置文件中
          file_put_contents('cunchuwenjian.php',$str);

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
	<div id='main'>
		<dl class='paper a1'>
			<dt>
				<span class='username'>李清照</span>
				<span class='num'>No.00001</span>
			</dt>
			<dd class='content'>红藕香残玉簟秋。轻解罗裳，独上兰舟。云中谁寄锦书来，雁字回时，月满西楼。
                花自飘零水自流。一种相思，两处闲愁。此情无计可消除，才下眉头，却上心头。</dd>
			<dd class='bottom'>
				<span class='time'>今天08:30</span>
				<a href="" class='close'></a>
			</dd>
		</dl>
		<dl class='paper a2'>
			<dt>
				<span class='username'>白居易</span>
				<span class='num'>No.00001</span>
			</dt>
			<dd class='content'>我闻琵琶已叹息，又闻此语重唧唧。
                同是天涯沦落人，相逢何必曾相识。</dd>
			<dd class='bottom'>
				<span class='time'>今天08:30</span>
				<a href="" class='close'></a>
			</dd>
		</dl>
		<dl class='paper a3'>
			<dt>
				<span class='username'>柳永</span>
				<span class='num'>No.00001</span>
			</dt>
			<dd class='content'>伫倚危楼风细细，望极春愁，黯黯生天际。草色烟光残照里，无言谁会凭阑意。(阑 通 栏)
                拟把疏狂图一醉，对酒当歌，强乐还无味。衣带渐宽终不悔，为伊消得人憔悴。</dd>
			<dd class='bottom'>
				<span class='time'>今天08:30</span>
				<a href="" class='close'></a>
			</dd>
		</dl>
		<dl class='paper a4'>
			<dt>
				<span class='username'>王勃</span>
				<span class='num'>No.00001</span>
			</dt>
			<dd class='content'>物华天宝，龙光射牛斗之墟；人杰地灵，徐孺下陈蕃之榻。雄州雾列，俊采星驰。</dd>
			<dd class='bottom'>
				<span class='time'>今天08:30</span>
				<a href="" class='close'></a>
			</dd>
		</dl>
		<dl class='paper a5'>
			<dt>
				<span class='username'>苏轼</span>
				<span class='num'>No.00001</span>
			</dt>
			<dd class='content'>壬戌之秋，七月既望，苏子与客泛舟游于赤壁之下。
                清风徐来，水波不兴。举酒属客，诵明月之诗，歌窈窕之章。少焉，月出于东山之上，徘徊于斗牛之间。
                白露横江，水光接天。纵一苇之所如，凌万顷之茫然。
                浩浩乎如凭虚御风，而不知其所止；飘飘乎如遗世独立，羽化而登仙。</dd>
			<dd class='bottom'>
				<span class='time'>今天08:30</span>
				<a href="" class='close'></a>
			</dd>
		</dl>


<!--        用php把数据抓过来组合到页面中-->

        <?php

//        重新引入存储源文件的php
        $x = include 'cunchuwenjian.php';

//        循环遍历数组 把对应的内容添加到dl对应位置上
        foreach ($x as $k=>$v ){


//             获得用户编号
              $no=$k+1;

//      echo  mt_rand(1,5);


//          混排方式实现1~5的随机数 随机dl的背景图
       echo "<dl class='paper a"?><?php echo mt_rand(1,5)?><?php echo "'>
			<dt>
				<span class='username'>{$x[$k]['username']}</span>
				
				<span class='num'>No.$no<a href=\"bianji.php?id=$k\"  style='text-decoration: none;color: palevioletred;font-size: 13px;'>编辑</a></span>
			</dt>
			<dd  style='color: saddlebrown'  class='content'>{$x[$k]['content']}<img src='{$x[$k]['pic']}' alt=''   style='width: 100px;height: 100px;display: block;margin: 0 auto;' ></dd>
			
			
			
			<dd class='bottom'>
				<span class='time'>{$x[$k]['time']}</span>
				<a href=\"shanchu.php?id=$k\" class='close'></a>
			</dd>
			
			
		</dl>";

        }

        ?>


	</div>

	<div id='send-form'>
		<p class='title'><span>许下你的愿望</span><a href="" id='close'></a></p>
		<form action=""   method="post"   name='wish' enctype="multipart/form-data">
			<p>
				<label for="username">昵称：</label>
				<input type="text" name='username' id='username'/>
			</p>
			<p>
				<label for="content">愿望：(您还可以输入&nbsp;<span id='font-num'>50</span>&nbsp;个字)</label>
				<textarea name="content" id='content'></textarea>
				<div id='phiz'>
					<img src="./Images/phiz/zhuakuang.gif" alt="抓狂" />
					<img src="./Images/phiz/baobao.gif" alt="抱抱" />
					<img src="./Images/phiz/haixiu.gif" alt="害羞" />
					<img src="./Images/phiz/ku.gif" alt="酷" />
					<img src="./Images/phiz/xixi.gif" alt="嘻嘻" />
					<img src="./Images/phiz/taikaixin.gif" alt="太开心" />
					<img src="./Images/phiz/touxiao.gif" alt="偷笑" />
					<img src="./Images/phiz/qian.gif" alt="钱" />
					<img src="./Images/phiz/huaxin.gif" alt="花心" />
					<img src="./Images/phiz/jiyan.gif" alt="挤眼" />
				</div>
			</p>

            <p  style="position: absolute;top: 57px;left:240px;width:90px;height:60px;border: 1px solid palevioletred;text-align: center;color: #00CC66;padding-top: 38px;border-radius: 5px;background: url('zx.jpg')  no-repeat;background-position: 50% 50%;">上传头像</p>

            <input type="file" name="pic"    style="position: absolute;top: 57px;left:240px;width:100px;height:100px;opacity: 0; "       >
			<label for="tijiao"><span id='send-btn'></span></label>
            <input   type="submit"  name="tijiao"  id="tijiao" style="display: none"  />


		</form>
	</div>
<!--[if IE 6]>
    <script type="text/javascript" src="./Js/iepng.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('#send,#close,.close','background');
    </script>
<![endif]-->
</body>
</html>