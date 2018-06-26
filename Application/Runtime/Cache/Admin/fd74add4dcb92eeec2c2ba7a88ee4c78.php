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
            .red:hover,.edit:hover{cursor: pointer;}
            .grade_manage{display: none!important;}
            #grade,#upd_g{max-width: 300px;display: inline-block;}
            .red{color:red;}
            .updbox{display:none;margin-top: 2em;}
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
            <h3 style="display:inline">年级管理</h3>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-sm-6" style="padding-left:0px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>年级</th>
                                    <th>修改</th>
                                    <th>删除</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="tbody"></tbody>
                        </table>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <input name="grade" class="form-control" id="grade" />
                        <button class="btn btn-primary" onclick="addGrade()">添加年级</button>
                        <form class="updbox" id="updbox">
                            <input name="grade" class="form-control"  id="upd_g" />
                            <input type="hidden" name="gid" id="gid">
                            <button class="btn btn-danger" onclick="updGrade()">修改年级</button>
                        </form>
                    </div>
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
    $("#exit").click(function() {
        if(confirm("你确定退出吗？")) {  
                location.href ="<?php echo U('Index/admin_exit');?>";  
            }else {  
                alert("取消");  
            } 
    });   
    function grade(){
        $.ajax({
            type:"POST",
            url:"/activity/index.php/admin/index/grade",
            data:" ",
            dataType: "JSON",
            success:function(json){
               $(".tbody").empty();
               $.each(json,function(index,obj){
                    var str='<tr>'+
                        '<td>'+obj.gid+'</td>'+
                        '<td>'+obj.grade+'</td>'+
                        '<td><span class="glyphicon glyphicon-edit edit" onclick="upd_grade('+obj.gid+')"></span></span></td>'+
                        '<td><span onclick="del_grade('+obj.gid+')"  class="glyphicon glyphicon-remove-circle red"'+
                    '></span></td></tr>';
                    $(".tbody").append(str);
               });
            }
        });
    }
    grade();   
    function del_grade(gid){
        if (confirm("你确定删除吗？")){  
            var ajaxDate='gid='+gid;
            $.ajax({
                type:'POST',
                url:"/activity/index.php/admin/index/delGrade",
                data:ajaxDate,
                dataType: "JSON",
                success:function(json){
                    if(json=="yes"){
                        alert("删除成功！");
                        grade();
                    }
                },
                error:function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.status+XMLHttpRequest.readyState+textStatus);
                },
            });
        }else {  
            alert("取消");  
        }       
    }
    // 添加年级
    function addGrade(){
       var data=$("#grade").val().trim();
       $.ajax({
            type:"POST",
            url:"/activity/index.php/admin/index/addGrade",
            data:'grade='+data,
            dataType: "JSON",
            success:function(json){
                grade();
                $("#grade").val("");
            },
            error:function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.status+XMLHttpRequest.readyState+textStatus);
                },
       });
    }
    //修改年级
    function upd_grade(gid){      
        $.ajax({
            type:'POST',
            url:"/activity/index.php/admin/index/upd_grade",
            data:"gid="+gid,
            dataType: "JSON",
            success:function(json){
                $("#upd_g").val(json.grade);
                $("#gid").val(json.gid);
                $('.updbox').show();
            },
        });
    }
    //修改年级操作
    function updGrade(){
         var ajaxDate=$("#updbox").serialize();
         console.log(ajaxDate);
         $.ajax({
            type:'POST',
            url:"/activity/index.php/admin/index/updGrade",
            data:ajaxDate,
            dataType: "JSON",
            success:function(json){
                grade();
                $('.updbox').hide();
            }
         });
    }
    </script>
    </body>
</html>