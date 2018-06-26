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
            .body{background: #fff;}
            .check:hover{cursor: pointer;}
            .index{display: none!important;}
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
                <li class="index"><a href="http://localhost/activity/index.php/Admin/index/index.html">审核活动</a></li>
                <li class="has_check"><a href="http://localhost/activity/index.php/Admin/index/has_check.html" >已审核的活动</a></li>
                <li class="stu_manage"><a href="http://localhost/activity/index.php/Admin/index/stu_manage.html" >学生管理</a></li>
                <li class="grade_manage"><a href="http://localhost/activity/index.php/Admin/index/grade_manage.html" >年级管理</a></li>
                <li><a href="#" id="exit">退出</a></li>
            </ul>
        </div>
    </div>
    </nav>
</header>	
    <!--头部}结束-->
    <!--主体{开始-->
    <div class="body">
    	<div class="contain_box" style="min-height:400px;padding:20px;">
            <div class="ac">
                <h3>审核活动</h3>     
            <div class="check_activity">
                <table class="table">
                    <thead>
                        <tr>
                            <th>活动id</th>
                            <th>活动主题</th>
                            <th>活动人数限制</th>
                            <th>活动创办人</th>          
                            <th>审核活动</th>
                        </tr>
                    </thead>
                    <tbody class="tbody"></tbody>
                </table>
                <ul class="pagination" id="page" style="margin: 20px 10px;"></ul>
            </div>
            </div>
            <h3 class="no_ac" style="display:none">目前没有需要审核的活动</h3>
        </div>
	</div>
	<!--主体}结束-->
	 <!--尾部{开始-->
    <div class="footer">
    <div class="links_item"><p class="copyright">郭大侠出品</p> </div>
</div>
    <!--尾部}结束-->
    <!-- 审核弹窗{开始 -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title ac_title"></h4>
                </div>
                <div class="modal-body">
                   <img class="ac_img" style="width:50%;margin-bottom:15px" />
                    <table class="table">
                        <tr><td>活动内容</td><td class="ac_content"></td></tr>
                         <tr><td>活动人数限制</td><td class="ac_limit"></td></tr>
                        <tr><td>活动时间</td><td class="ac_time"></td></tr>
                        <tr><td>活动截止时间</td><td class="ac_adeadline"></td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default ac_no" acid="
                    1">不通过</button>
                    <button type="button" class="btn btn-primary ac_yes" acid="2">通过</button>
                </div>
            </div>
        </div>
    </div>
<!-- 审核弹窗}结束 -->
    <script>
    $("#modal").modal('hide');
    $("#exit").click(function() {
        if (confirm("你确定退出吗？")) {  
                location.href ="<?php echo U('Index/admin_exit');?>";  
            }  
            else {  
                alert("取消");  
            } 
    });
    var page_cur = 1; //当前页 
    var total_num, page_size, page_total_num;//总记录数,每页条数,总页数
    function pageArea(page_cur,page_total_num){
        var page_str='';
        if (page_cur>page_total_num){page_cur=page_total_num;}
        if (page_cur<1){ page_cur = 1;} //当前页小于1   
        var next="<li><a href='#' onclick='activity("+(parseInt(page_cur)+1)+")'>下一页</a></li>";
        var pre="<li><a href='#' onclick='activity("+(parseInt(page_cur)-1)+")'>上一页</a></li>";
        var first="<li><a href='#' onclick='activity(1)'>首页</a></li>";
        var last="<li><a href='#' onclick='activity("+page_total_num+")'>尾页</a></li>";
        if(page_cur==1){
            page_str+=next+last; 
        }else if(page_cur>= page_total_num){
            page_str+=first+pre;
        }else{
            page_str+=first+next+pre+last;
        }
        if(page_total_num==1){page_str='';} 
        return page_str;
    }
    function check_result(acid,flag){
        $.ajax({
            type:'POST',
            url:'/activity/index.php/admin/index/check_result',
            data:'acid='+acid+'&flag='+flag,
            dataType:'json',
            success:function(json){
                if(json){
                    $("#modal").modal('hide');
                    activity(page_cur);
                }else{
                    alert("审核失败");
                }
                // alert(json);
            },
        });
    }
    function check(acid){
        $.ajax({
            type:'POST',
            url:'/activity/index.php/admin/index/check',
            data:'acid='+acid,
            dataType:'json',
            success:function(json){
                 $("#modal").modal();
                 $(".ac_img").attr('src','/Activity/'+json.aimg);
                 var ac_limit,ac_num;
                 if(json.alimit>0){
                    ac_limit=json.alimit;
                 }else{
                     ac_limit="没有人数限制";
                 }
                 $(".ac_title").html(json.actitle);
                 $(".ac_time").html(json.actime);
                 $(".ac_limit").html(ac_limit);
                 $(".ac_content").html(json.accontent);
                 $(".ac_adeadline").html(json.adeadline);
                 $(".ac_no").attr("acid",json.acid);
                 $(".ac_yes").attr("acid",json.acid);
            },
        });
    }
    function activity(page){
        var page1=page-1;
        $.ajax({
            type:"POST",
            url:"/activity/index.php/admin/index/check_activity",
            data:"page=" +page1,
            dataType: "JSON",
            success:function(json){
                    total_num = json.total_num; //总记录数 
                    page_size = json.page_size; //每页数量 
                    page_cur = page; //当前页 
                    page_total_num = json.page_total; //总页数 
                    var data = json.list; 
                    $(".tbody").empty();
                    if(data){
                        $(".ac").show();
                       $(".no_ac").hide();
                        $.each(data,function(index,obj){
                            var limit;
                            if(obj.alimit>0){
                                limit=obj.alimit;
                            }else{
                                limit="没有人数限制";
                            }
                            console.log(obj);
                            var str='<tr>'+
                                    '<td>'+obj.acid+'</td>'+
                                    '<td>'+obj.actitle+'</td>'+
                                    '<td>'+limit+'</td>'+
                                    '<td>'+obj.sname+'</td>'+
                                    '<td><span class="glyphicon glyphicon-check check" acid='+obj.acid+'></span>'+
                                    '</tr>';
                            $(".tbody").append(str);
                        });
                        $(".check").each(function(){
                            $(this).click(function(){
                                var acid=$(this).attr("acid");
                                check(acid);
                            })
                        });
                    }else{
                        $(".ac").hide();
                       $(".no_ac").show();
                    }
                    
                    },
            complete: function() {
                        var page_str=pageArea(page_cur,page_total_num);
                        $("#page").html(page_str);
                      }, 

        });
    }
    activity(page_cur);
     $(".ac_no").click(function(){
        check_result($(this).attr('acid'),2);
     });
     $(".ac_yes").click(function(){
        check_result($(this).attr('acid'),1);
     });
    </script>
    </body>
</html>