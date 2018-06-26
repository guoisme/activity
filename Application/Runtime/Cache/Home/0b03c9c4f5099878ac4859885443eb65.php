<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="guo">
		<title>修改账户信息</title>
        <link rel="icon" type="image/png" href="/activity/Avatar/logo.png">
		<link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/activity/Public/css/style.css" />
		<script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
		<script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
		<style>
			.red{color: red;}
			.create_t{margin:30px  10px;}
			.upd_a:hover,.del_a:hover,.acid:hover,.head:hover{cursor: pointer;}
		</style>
	</head>
	<body>
	<!--头部{开始-->
		<header class="header">
    <nav class="navbar navbar-inverse <!--navbar-fixed-top-->" id="headernav">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand logo" href="javascript:void(0)">华广校园活动组队平台</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">            
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a class="member_head" href="javascript:void(0)"><img id="member_head" src=""><span class="member_name">一剪梅</span></a></li>
                <li><a href="#" id="exit">退出</a></li>
            </ul>
        </div>
    </div>
    </nav>
</header>
    <!--头部}结束-->
    <!--主体{开始-->
    <div class="body">
    	<div class="contain_box">
             <div class="col_side">
    <ul>                   
        <li><a href="http://localhost/activity/index.php/Home/index/has_create.html">已创建的活动</a></li>
        <li><a href="http://localhost/activity/index.php/Home/index/activity.html">创建活动</a></li>
        <li><a href="http://localhost/activity/index.php/Home/index/has_signup.html">已报名的活动</a></li>

    </ul>
    <ul>
        <li><a href="http://localhost/activity/index.php/Home/index/upd.html">账户信息</a></li>
        <li><a href="http://localhost/activity/index.php/Home/index/pwd_upd.html">修改密码</a></li>
        <li><a href="http://localhost/activity/index.php/Home/index/index.html">首页</a></li>
    </ul>
</div>
        <div class="col_main">
			<div class="right_contain">            
			    <h3 style="margin-left: 10px;padding-bottom:10px" class="table_title">修改账户信息</h3>
			     <form style="border:1px solid  #d9dadc;margin-left:10px;padding:15px;" action="http://localhost/activity/index.php/Home/index/update" method="post">
			     	<div class="form-group">
			     	    <label for="snum">头像：</label>
                        <div class="head">
                        	<span  data-toggle="tooltip" data-placement="right" title="点击修改头像">
                         <img src="" />
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="snum">学号：</label>
                        <input type="text" class="form-control" name="snum" value="{$data.snum}">
                    </div>
                     <div class="form-group">
                        <label for="snickname">昵称：</label>
                        <input type="text" class="form-control" name="snickname" value="<?php echo ($data["snickname"]); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sname">姓名：</label>
                        <input type="text" class="form-control" name="sname" value="<?php echo ($data["sname"]); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ssex">性别:</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="ssex" id="ssex1" value="1">男
                            </label>
                            <label>
                                <input type="radio" name="ssex" id="ssex0" value="0">女
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sgrade">年级：</label>
                        <select class="form-control" name='gid'>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class="sgrade"  value="<?php echo ($vo["gid"]); ?>" gid="<?php echo ($vo["gid"]); ?>"><?php echo ($vo["grade"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="smajor">专业：</label>
                        <input type="text" class="form-control" name="smajor" value="<?php echo ($data["smajor"]); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ssign">个性签名：</label>
                        <textarea class="form-control" name="ssign"><?php echo ($data["ssign"]); ?></textarea>
                    </div>
                    <input type="hidden" id="sid" name="sid" value="<?php echo ($data["sid"]); ?>">
                    <button type="submit" class="btn btn-default">确定</button>
			     </form>
			</div>
		</div>
    </div>
	</div>
	<!--主体}结束-->

	 <!--尾部{开始-->
    <div class="footer">
    <div class="links_item"><p class="copyright">郭大侠出品</p> </div>
</div>
    <!--尾部}结束-->
    
    
 
    <script>
        var src='/activity<?php echo ($shead["img"]); ?>_60.jpg';
        $(".head img").attr('src',src);
        $("#member_head").attr('src',src);
    	 $(".member_name").text('<?php echo ($shead["sname"]); ?>');
    	   $("#exit").click(function(){
        	 if (confirm("你确定退出吗？")) {  
                location.href ="<?php echo U('Index/stu_exit');?>";  
            }  
            else {  
                alert("取消");  
            } 
        });
        $("[data-toggle='tooltip']").tooltip();       
    	if(<?php echo ($data["ssex"]); ?>==1){$("#ssex1").attr("checked","checked");}else{$("#ssex0").attr("checked","checked");}  
        $(".sgrade").each(function(){
            if($(this).attr('gid')==<?php echo ($data["gid"]); ?>){
                $(this).attr("selected", true);
            }
         }); 
        $(".head").click(function(){
           location.href ="<?php echo U('Index/head_upd');?>";
        });
    </script>
    </body>
</html>