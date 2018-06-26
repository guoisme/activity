<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="guo">
		<title>活动报名情况</title>
        <link rel="icon" type="image/png" href="/activity/Avatar/logo.png">
		<link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/activity/Public/css/style.css" />
		<script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
		<script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="/activity/Public/js/page.js" ></script>
        <style type="text/css">
            .create_t{margin:30px  10px;}
            .flag_click:hover{cursor: pointer;}
            .flag_click{color: blue;}
            .stu_head{width:100px;height:100px;-webkit-border-radius:50px;-moz-border-radius:50px;border-radius:50px;margin: 10px 0;}
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
                    <h3 style="margin-left: 10px;" class="table_title">活动报名情况</h3>
                    <table class="table table-hover create_t" id="c_table">
                        <thead>
                            <tr>
                                <th class="stu_name">姓名</th>
                                <th class="stu_sex">性别</th>
                                <th class="stu_grade">年级</th>
                                <th class="stu_major">专业</th>
                                <th>审核情况</th>
                            </tr>
                        </thead>
                        <tbody class="tbody"></tbody>
                    </table>
                    <ul class="pagination" style="margin: 20px 10px;" id="page"></ul>
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
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
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
                    <button type="button" class="btn btn-default yes" sid="0">通过</button>
                    <button type="button" class="btn btn-primary no" sid="0">不通过</button>
                </div>
            </div>
        </div>
    </div>
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
        var acid=<?php echo ($acid); ?>;
         $('#myModal').modal('hide');
        function stu_check(sid,acid,flag){
            $.ajax({
                type:"POST",
                url:"/activity/index.php/home/index/stu_check",
                data:"sid="+sid+"&flag="+flag+"&acid="+acid,
                dataType:"json",
                success:function(json){
                    console.log(json);
                    if(json){
                        $('#myModal').modal('hide');
                        student(page_cur,<?php echo ($acid); ?>);
                    }
                },
                error:function(){alert("数据异常,请检查是否json格式");},
            });
        }
        function  sign_man(sid){
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
                    $(".yes").attr("sid",json.sid);
                     $(".no").attr("sid",json.sid);
                   
                },
                error:function(){alert("数据异常,请检查是否json格式");},
            });
            $('#myModal').modal();
        }
        var page_cur = 1; //当前页 
        var total_num, page_size, page_total_num;//总记录数,每页条数,总页数 
        function student(page,acid){
            var page1=page-1;
            $.ajax({
                type: 'POST', 
                url: '/activity/index.php/home/index/ac_sign_data', 
                data: "acid="+acid+"&page="+page1, 
                dataType: 'JSON', 
                success: function(json) { 
                    $(".tbody").empty(); 
                    total_num = json.total_num; //总记录数 
                    page_size = json.page_size; //每页数量 
                    page_cur = page; //当前页 
                    page_total_num = json.page_total; //总页数 
                    var data = json.list;
                    $.each(data,function(index,obj){
                        // console.log(obj);
                        var ssex_text,flag_text;
                        if(obj.ssex==0){ssex_text="女"}else{ssex_text="男";}
                        if(obj.flag==0){flag_text="未审核";}else if(obj.flag==1){flag_text="报名成功";}else{flag_text="报名失败";}
                       var str='<tr>'+
                                '<td>'+obj.sname+'</td>'+
                                '<td>'+ssex_text+'</td>'+
                                '<td>'+obj.sgrade+'</td>'+
                                '<td>'+obj.smajor+'</td>'+
                                '<td sid="'+obj.sid+'" class="check" flag="'+obj.flag+'">'+flag_text+'</td>'+
                                '</tr>';
                        $(".tbody").append(str);                        
                    });
                    $('.check').each(function(){
                           var flag=$(this).attr("flag");
                           if(flag==0){
                                $(this).addClass("flag_click");
                                $(this).on("click",function(){
                                    var sid=$(this).attr("sid");
                                    sign_man(sid);
                                });
                           }
                        });

                },
                error:function(){alert("数据异常,请检查是否json格式");},
                complete: function() {
                    var page_str=pageArea(page_cur,page_total_num);
                    $("#page").html(page_str);
                }, 
            });
        }
        student(page_cur,<?php echo ($acid); ?>);
        $(".yes").click(function(){
            stu_check($(this).attr('sid'),acid,1);
        });
        $(".no").click(function(){
            stu_check($(this).attr('sid'),acid,2);
        });
    </script>
    </body>
</html>