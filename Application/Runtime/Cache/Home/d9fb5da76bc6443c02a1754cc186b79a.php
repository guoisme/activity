<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="guo">
	<title>创建活动</title>
    <link rel="icon" type="image/png" href="/activity/Avatar/logo.png">
	<link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/activity/Public/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="/activity/Public/css/style.css" />
	<script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
	<script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="/activity/Public/js/bootstrap-datetimepicker.min.js" ></script>
    <style type="text/css">
        #change_click{display:block;width:150px}
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
               <h3 style="margin-left: 10px;">创建活动</h3>
               <form style="margin-left: 10px;padding-top:10px;padding-bottom:10px" action="http://localhost/activity/index.php/Home/index/create_activity" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                       <label>活动图片宣传</label>
                        <input type="file" name="aimg"  id="info_photo" onchange='PreviewImage(this)' style="display:none"/>
                        <span class="btn btn-default btn-file" onclick="$('input[id=info_photo]').click();" id="change_click"> 选择图片<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                        </span>
                        <div id="photo_info" class="photo_info"></div>
                   </div>
                   <div class="form-group">
                        <label for="actitle">活动标题</label>
                        <input type="text" class="form-control" name="actitle" >
                    </div>
                    <div class="form-group">
                        <label for="accontent">活动内容</label>
                        <textarea class="form-control" rows="3" name="accontent"></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="accontent">活动人数限制</label>
                        <input type="text" class="form-control" name="alimit"  placeholder="无限制可不填">
                    </div>                     
                     <div class="form-group">
                        <label for="adeadline">活动截止报名时间</label>                   
                        <input type="text" class="form-control form_datetime"  id="adeadline" name="adeadline"  >
                    </div>
                    <div class="form-group">
                        <label for="actime">活动时间</label>                   
                        <input type="text" class="form-control form_datetime" id="actime"  name="actime"  >
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:150px">确定</button>
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
    // 获取当前日期
      function getNowFormatDate() {
        var date = new Date();
        var seperator1 = "-";
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = year + seperator1 + month + seperator1 + strDate;
        return currentdate;
    }
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
    	$('#adeadline').datetimepicker({
            minView: "month", 
            language:  'zh-CN',
            format: 'yyyy-mm-dd',
            autoclose: 1,
            pickerPosition: "top-left",
            startDate:getNowFormatDate()
        });
        $('#actime').datetimepicker({
            minView: "month", 
            language:  'zh-CN',
            format: 'yyyy-mm-dd',
            autoclose: 1,
            pickerPosition: "top-left",
            startDate:getNowFormatDate()
        });
        $('#actime').focus(function(){
            var adeadline=$('#adeadline').val();
            $(this).datetimepicker('setStartDate',adeadline);
        });
            //上传图片立即预览
 function PreviewImage(imgFile) {
  var filextension = imgFile.value.substring(imgFile.value
    .lastIndexOf("."), imgFile.value.length);
  filextension = filextension.toLowerCase();
  if ((filextension != '.jpg') && (filextension != '.gif')
    && (filextension != '.jpeg') && (filextension != '.png')
    && (filextension != '.bmp')) {
   alert("对不起，系统仅支持标准格式的照片，请您调整格式后重新上传，谢谢 !");
   imgFile.focus();
  } else {
   var path;
   if (document.all)//IE
   {
    imgFile.select();
    path = document.selection.createRange().text;
    document.getElementById("photo_info").innerHTML = "";
    document.getElementById("photo_info").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\""
      + path + "\")";//使用滤镜效果  
   } else//FF
   {
    path = window.URL.createObjectURL(imgFile.files[0]);// FF 7.0以上
    //path = imgFile.files[0].getAsDataURL();// FF 3.0
    document.getElementById("photo_info").innerHTML = "<img id='img1' width='300px'  src='"+path+"'/>";
    //document.getElementById("img1").src = path;
   }
  }
 }
    </script>
    </body>
</html>