<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="guo">
        <link rel="icon" type="image/png" href="/activity/Avatar/logo.png">
		<title>修改密码</title>
		<link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/activity/Public/css/style.css" />
		<script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
		<script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
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
               <div class="pwd_form">
                   <h3 style="margin-left: 10px;" class="table_title">修改密码</h3>
               <div style="width:300px;min-height:200px;margin:10px auto;">
                    <div class="form-group">
                    <label for="password1">旧密码</label>
                    <input type="text" class="form-control password1" placeholder="旧密码">
                            
                </div>
                <div class="form-group">
                    <label for="password2">新密码</label>
                    <input type="text" class="form-control password2" placeholder="新密码">                             
                </div>                    
                    <button class="btn btn-default" id="pwd">Submit<button>
               </div>
               </div>
               <h3 id="sussess" style="display:none"><span style="margin-right: 4px;"><img  src="/activity/Public/img/smile.png" style="width:30px;height:30px;"></span>恭喜修改密码成功！</h3>

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
        $("#pwd").click(function(){
            var password1=$(".password1").val();
            var password2=$('.password2').val();
            $.ajax({
                type:"POST",
                url:"/activity/index.php/home/index/pwd",
                data:'password1='+password1+'&password2='+password2,
                dataType:"json",
                success:function(json){
                    console.log(json);
                   if(json==0){
                    alert("原密码错误");
                   }else if(json==1){
                    alert("修改密码失败");
                   }else{
                    $(".pwd_form").hide();
                    $("#sussess").show();
                   }
                },
                error:function(){}
            });
        });
    </script>
    </body>
</html>