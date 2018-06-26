<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="guo">
		<title>华广校园活动组队平台</title>
        <link rel="icon" type="image/png" href="/activity/Avatar/logo.png">
		<link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/activity/Public/css/style.css" />
		<script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
		<script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
		<style type="text/css">
			.activity_box{float: left;width: 360px;margin-right:40px;padding: 10px;background-color: #fff;margin-bottom: 50px;}
			.activity{clear: both;height: 400px;}
			/*.line{height: 1px;background: #ddd;margin-bottom: 10px;}*/
            .ac_aimg{width: 338px;height: 200px}
			.ac_main{margin-bottom: 20px;}
			.ac_man:hover,.pwd:hover{cursor: pointer;}
            .sign{background-color: #000;color: #fff;width: 100px;}
            .ac{width: 100px;margin-right: 139px;}
            .pager{padding-right: 40px;}
            .stu_head{width:100px;height:100px;-webkit-border-radius:50px;-moz-border-radius:50px;border-radius:50px;margin: 10px 0;}
            #loginForm{margin: 10px 30px;}
            .form_input{float:right;top:-23px;right:5px}
            .table tr td:first-child{width:130px}
             .table{margin-top:15px;margin-bottom: 0}
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
                        <li class="active" style="display:none"><a class="member_head" href="javascript:void(0)"><img id="member_head" src=""><span class="member_name">一剪梅</span></a></li>
                        <li class="login"><a>登录</a></li>
                        <li class="personal"><a>个人中心</a></li>
                        <li class="register"><a href="http://localhost/activity/index.php/Home/index/register.html">注册</a></li>
                        <li><a href="#" id="exit" style="display:none">退出</a></li>
                    </ul>
                </div>
            </div>
            </nav>
        </header>
    <!--头部}结束-->
    <!--主体{开始-->
    <div class="body">
    	<div class="contain_box" style="min-height:400px;">
            <div class="activity"></div>
            <ul class="pagination pager"></ul>
        </div>
	</div>
	<!--主体}结束-->
	 <!--尾部{开始-->
    <div class="footer">
    <div class="links_item"><p class="copyright">郭大侠出品</p> </div>
</div>
    <!--尾部}结束-->
    <!-- 创建人弹窗{开始 -->
      <div class="modal fade" id="stu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title ac_name" id="myModalLabel">个人名片</h4>
                </div>
                <div class="modal-body">
                    <img  class="stu_head"/>
                    <table class="table">
                        <tr><td>姓名</td><td class="stu_name"></td></tr>
                        <tr><td>昵称</td><td class="stu_nickname"></td></tr>
                        <tr><td>年级</td><td class="stu_grade"></td></tr>
                        <tr><td>专业</td><td class="stu_major"></td></tr>
                        <tr><td>个性签名</td><td class="stu_sign"></td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 创建人弹窗}结束 -->
     <!-- 活动详情弹窗{开始-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ac_title" id="myModalLabel"></h4>
        </div>
   
        <div class="modal-body">
            <img class="ac_img" style="width:50%">
            <table class="table">
            	<tr>
            		<td>活动内容</td><td class="ac_content"></td>
            	</tr>
            	<tr>
            		<td>活动时间</td><td class="ac_time"></td>
            	</tr>
            	<tr>
            		<td>活动截止时间</td><td class="ac_deadline"></td>
            	</tr>
                <tr>
                    <td>活动参与人数限制</td><td class="ac_alimit"></td>
                </tr>
                <tr>
                    <td>报名情况</td><td class="ac_num"></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- 活动详情弹窗}结束-->
  <!--登录弹窗{开始 -->
      <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title ac_name" id="myModalLabel">登录弹窗</h4>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="username">用户名</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
                            <span class="glyphicon glyphicon-user form_input"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input type="password" class="form-control password1" name="password" placeholder="密码">
                            <input type="text" class="form-control password2" name="password" style="display:none"  placeholder="密码">
                            <span class="glyphicon glyphicon-eye-close form_input pwd"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn login_btn" style="background:#000;color:#fff">登录</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 登录弹窗}结束 -->
    <script>
    var snum=0;
    snum=<?php echo ($snum); ?>;
    if(snum!=0){
        var src='/activity<?php echo ($shead["img"]); ?>_60.jpg';
        $("#member_head").attr('src',src);
    	$(".member_name").text('<?php echo ($shead["sname"]); ?>');
    	$(".login").hide();
    	$(".active").show();
    	$("#exit").show();
    	$(".register").hide();
    }else{
    	$(".login").show();
    	$(".active").hide();
    	$("#exit").hide();
    }
    $("#exit").click(function(){
        if (confirm("你确定退出吗？")) {  
            location.href ="<?php echo U('Index/stu_exit');?>";  
        }  
        else {  
            alert("取消");  
        } 
    });
    $("#stu").modal('hide');
    function stu(sid){
            $.ajax({
                type:"POST",
                url:"/activity/index.php/home/index/stu",
                data:"sid="+sid,
                dataType:"json",
                success:function(json){

                    var src='/activity'+json.shead+'_100.jpg';
                    $(".stu_head").attr("src",src);
                    $(".stu_name").html(json.sname);
                    $(".stu_nickname").html(json.snickname);
                    $(".stu_grade").html(json.sgrade);
                    $(".stu_major").html(json.smajor);
                    $(".stu_sign").html(json.ssign);
                    $("#stu").modal();
                },
            });
    }
    var page_cur = 1; //当前页 
    var total_num, page_size, page_total_num;//总记录数,每页条数,总页数 
    function pageArea(page_cur,page_total_num){
    	var page_str='';
            if (page_cur>page_total_num){page_cur=page_total_num;}
            if (page_cur<1){ page_cur = 1;} //当前页小于1 
            var pre='<li class="previous"><a href="#" onclick="activity('+(parseInt(page_cur)-1)+')"><span aria-hidden="true">&larr;</span> Older</a></li>';
            var next='<li class="next"><a href="#" onclick="activity('+(parseInt(page_cur)+1)+')">Newer <span aria-hidden="true">&rarr;</span></a></li>';
            if(page_cur==1){
              page_str+=next; 
            }else if(page_cur>= page_total_num){
              page_str+=pre;
            }else{
              page_str+=pre+next;
            }
            if(page_total_num==1){page_str='';} 
            // $("#page").html(page_str);
            return page_str;
    }
    function activity(page){
        var page1=page-1;
    	$.ajax({
        type: 'POST', 
        url: '/activity/index.php/home/index/index_activity', 
        data: "page="+page1, 
        dataType: 'JSON', 
        success: function(json) { 
            $(".activity").empty(); 
            total_num = json.total_num; //总记录数 
            page_size = json.page_size; //每页数量 
            page_cur = page; //当前页 
            page_total_num = json.page_total; //总页数 
            var data = json.data;
            $.each(data,function(index,obj){
               var str='<div class="activity_box">'+
               '<div class="ac_man" sid="'+obj.sid+'">创建人:'+obj.snickname+'</div>'+
               '<img class="ac_aimg" src="/activity/'+obj.aimg+'" />'+ 

            	'<h3 class="ac_main">'+obj.actitle+'</h3>'+
            	'<div class="ac_btn">'+
            		'<button type="button"  class="btn btn-default ac" acid="'+obj.acid+'">活动详情</button>'+
            		'<button type="button"  class="btn btn-default sign"  acid="'+obj.acid+'">报名</button>'+
            	'</div></div>';
            	$(".activity").append(str);
            });
            $(".ac_man").each(function(){
            	$(this).click(function(){
                   // alert($(this).attr("sid"));
                   stu($(this).attr("sid"));
            	});
            });
            $(".sign").each(function(){
            	$(this).click(function(){
                     if (confirm("你确定报名吗？")) {  
                      signUp($(this).attr("acid"),snum);  
                     }else {  
                         alert("取消报名");  
                     } 
            	});
            });
             $(".ac").each(function(){
            	$(this).click(function(){
                   activity_detail($(this).attr("acid"));
            	});
            });
        },
         complete: function() {
                var page_str=pageArea(page_cur,page_total_num);
                $(".pager").html(page_str);
         }, 
        });
    }
    activity(page_cur);
    // 活动报名
    function signUp(acid,snum){
    	$.ajax({
    		type: 'POST', 
            url: '/activity/index.php/home/index/signUp', 
            data: "acid="+acid+"&snum="+snum, 
            dataType: 'JSON', 
            success: function(json){
                console.log(json);
            	if(json==0){
            		alert("这个活动您已经报名过了");
            	}else if(json==1){
            		alert("恭喜报名成功");
            	 }else if(json==3){
                    alert("活动报名名额已经满了哦");
                 }else if(json==2){
            		alert("登录后才能报名哦！");
            	}else if(json==4){
                    alert('您已经报名了其他同时间举办的活动了。');
                }
             },
    	});
    }     
    //活动详情
    $("#myModal").modal('hide');
    function activity_detail(acid){
        var ajaxUrl = "/activity/index.php/home/index/my_detail";
        var ajaxData = "acid=" +acid;
        $.ajax({
          type:"POST",
          url: ajaxUrl,
          data:ajaxData,
          dataType: "JSON",
          success:function(data){
            var ac_src='/activity/'+data.aimg;
           $(".ac_img").attr('src',ac_src);
          $(".ac_title").html(data.actitle);
          $(".ac_content").html(data.accontent);
          $(".ac_time").html(data.actime);
          var ac_alimit_text,ac_num_text;
          if(data.acnum>0){
              ac_num_text=data.acnum;
          }else{
            ac_num_text="还没有人报名";
          }
          console.log(data.acnum);
        if(data.alimit==0){
            ac_alimit_text="无限制";
          }else{
            ac_alimit_text=data.alimit;
            var ming=data.alimit-data.acnum;
            if(ming<5){
              $('.ac_num').css('color','red');
              ac_num_text+='(仅剩'+ming+'个名额)';
            }
          }
          $(".ac_num").html(ac_num_text);
          $(".ac_alimit").html(ac_alimit_text);
          $(".ac_deadline").html(data.adeadline);
          $('#myModal').modal();
          },
        });
    }
    //登录
    $("#login").modal('hide');
    $(".login").click(function(){
    	$("#login").modal();
    });
    $(".pwd").click(function(){
    	var $val=$(".password1").val();
        var $val2=$(".password2").val();
    	var display=$(".password1").css("display");//闭眼
        if(display=="none"){
            $(".password1").val($val2);
            $(".password2").hide();
            $(".password1").show();       
            $(".pwd").removeClass("glyphicon-eye-open");
            $(".pwd").addClass("glyphicon-eye-close");
        }else{
       	    $(".password2").val($val);
            $(".password1").hide();
            $(".password2").show();
            $(".pwd").removeClass("glyphicon-eye-close");
            $(".pwd").addClass("glyphicon-eye-open");
        }
    });
    $(".login_btn").click(function(){
    	var $val=$(".password1").val();
        var $val2=$(".password2").val();
        var username=$("#username").val();
        var password;
        if($val){
        	password=$val;
        }else{
        	password=$val2;
        }
    	$.ajax({
            type: 'POST', 
            url: '/activity/index.php/home/index/check_login', 
            data:'username='+username+'&password='+password, 
            dataType: 'JSON', 
            success: function(json) {
            	if(json==0){
            		alert("用户名或密码错误");
            	}else{
                   var src='/activity'+json.img+'_60.jpg';
                   $("#member_head").attr('src',src);
    	           $(".member_name").text(json.sname);
    	           snum=json.snum;
    	           $(".login").hide();
    	           $(".active").show();
    	           $("#login").modal('hide');
    	           $(".register").hide();
    	           $("#exit").show();
            	}
            },
        });
    });
    $(".personal").click(function(){
        if(snum!=0){
        	location.href="<?php echo U('Index/has_create');?>";
        }else{
        	alert("登录后才能进入个人中心哦");
        }
    });
    </script>
    </body>
</html>