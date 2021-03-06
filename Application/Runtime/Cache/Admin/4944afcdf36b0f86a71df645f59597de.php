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
            .stu_manage{display: none!important;}
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
            <h3 style="display:inline">学生管理</h3>    
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" 
                    data-toggle="dropdown">查询<span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" class="select_g" gid="all">全部</a></li>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="#" class="select_g" gid="<?php echo ($vo["gid"]); ?>"><?php echo ($vo["grade"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div> 
            <div class="ac">
                <div class="checked" style="margin-top:20px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>学号</th>
                            <th>姓名</th>
                            <th>昵称</th>          
                            <th>性别</th>
                            <th>年级</th>
                            <th>专业</th>
                            <th>修改</th>
                            <th>删除</th>
                        </tr>
                    </thead>
                    <tbody class="tbody"></tbody>
                </table>
                <ul class="pagination" id="page" style="margin: 20px 10px;"></ul>
            </div>
            </div>
            <h3 class="no_ac" style="display:none"></h3>
        </div>
	</div>
	<!--主体}结束-->
	 <!--尾部{开始-->
    <div class="footer">
    <div class="links_item"><p class="copyright">郭大侠出品</p> </div>
</div>
    <!--尾部}结束-->
    <!-- 修改弹窗 -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">学生信息修改</h4>
            </div>
            <div class="modal-body">
                <img class="shead" style="margin-bottom:15px" />
                <form  role="form" id="stuUpd">
                   <div class="form-group">
                       <label>学号：</label>
                       <input  id="snum" name="snum" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>密码：</label>
                        <input  id="spwd" name="spwd" class="form-control" type="password"/>
                    </div>
                    <div class="form-group">
                        <label>昵称：</label>
                        <input  id="snickname" name="snickname" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>姓名：</label>
                        <input id="sname"  name="sname" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>性别：</label>
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
                        <label>年级：</label>
                        <!-- <input  id="sgrade" name="sgrade"  class="form-control"/> -->
                        <select class="form-control" name='gid'>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo["gid"]); ?>"><?php echo ($vo["grade"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label>专业：</label>
                        <input  id="smajor" name="smajor"  class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>个性签名：</label>
                        <textarea id="ssign" name="ssign"  class="form-control"></textarea> 
                    </div>
                    <input type="hidden" name="sid" id="sid"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary stu-submit">保存</button>
            </div>
        </div>
    </div>
    </div>
    <script>
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
    var gid=0;
    function pageArea(page_cur,page_total_num){
        var page_str='';
        if (page_cur>page_total_num){page_cur=page_total_num;}
        if (page_cur<1){ page_cur = 1;} //当前页小于1   
        var next="<li><a href='#' onclick='student("+(parseInt(page_cur)+1)+","+gid+")'>下一页</a></li>";
        var pre="<li><a href='#' onclick='student("+(parseInt(page_cur)-1)+","+gid+")'>上一页</a></li>";
        var first="<li><a href='#' onclick='student(1,"+gid+")'>首页</a></li>";
        var last="<li><a href='#' onclick='student("+page_total_num+","+gid+")'>尾页</a></li>";
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
    function student(page,gid){
        console.log(gid);
        var page1=page-1;
        $.ajax({
            type:"POST",
            url:"/activity/index.php/admin/index/student",
            data:"page=" +page1+'&gid='+gid,
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
                            if(obj.ssex==0){obj.ssex_text="女";}
                            else{obj.ssex_text="男";}
                            var str='<tr>'+
                                    '<td>'+obj.snum+'</td>'+
                                    '<td>'+obj.sname+'</td>'+
                                    '<td>'+obj.snickname+'</td>'+           
                                    '<td>'+obj.ssex_text+'</td>'+
                                    '<td>'+obj.sgrade+'</td>'+
                                    '<td>'+obj.smajor+'</td>'+                   
                                    '<td><span class="glyphicon glyphicon-edit upd_a" onclick="upd_stu('+obj.sid+')"></span></span></td>'+
                    '<td><span onclick="del_stu('+obj.sid+')"  class="del glyphicon glyphicon-remove-circle red"'+
                    '></span></td></tr>';
                            $(".tbody").append(str);
                        });
                          
                    }else{
                       $(".ac").hide();
                       $(".no_ac").show();
                       $(".no_ac").empty();
                       var text="目前没有该年级的学生";                        
                       $(".no_ac").html(text);
                    }
                    
                    },
            complete: function() {
                        var page_str=pageArea(page_cur,page_total_num);
                        $("#page").html(page_str);
                      }, 

        });
    }
   
    student(page_cur,gid); 
    $("#modal").modal('hide');

    function upd_stu(sid){
        $.ajax({
            type:'POST',
            url:"/activity/index.php/admin/index/upd_stu",
            data:"sid="+sid,
            dataType: "JSON",
            success:function(json){
                 var src='/activity'+json.shead+'_100.jpg';
                $(".shead").attr('src',src);
                $("#snum").val(json.snum);
                $("#spwd").val(json.spwd);
                $("#snickname").val(json.snickname);
                $("#sname").val(json.sname);
                $(".sgrade").each(function(){
                   if($(this).attr('gid')==json.gid){
                     $(this).attr("selected", true);
                   }
                });
                $("#smajor").val(json.smajor);
                $("#ssign").val(json.ssign);
                $("#sid").val(json.sid);
                if(json.ssex==0){
                    $("#ssex0").attr('checked',true);
                }else{
                    $("#ssex1x").attr('checked',true);
                }
                $("#modal").modal();
            },

        });
    }
    // 保存修改的数据
    $(".stu-submit").on("click",function(){
        var ajaxDate=$("#stuUpd").serialize();
         $.ajax({
            type:'POST',
            url:"/activity/index.php/admin/index/saveStu",
            data:ajaxDate,
            dataType: "JSON",
            success:function(json){
               $("#modal").modal('hide');
               student(page_cur,gid);
            }
         });
    });
    function del_stu(sid){
        var ajaxDate='sid='+sid;
        $.ajax({
            type:'POST',
            url:"/activity/index.php/admin/index/delStu",
            data:ajaxDate,
            dataType: "JSON",
            success:function(json){
                 console.log(json);
                 alert("删除成功！")
                student(page_cur,grade);
            },
            error:function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.status+XMLHttpRequest.readyState+textStatus);
            },
        });
    }
    
     $(".select_g").each(function(){
        $(this).click(function(){
            gid=$(this).attr("gid");
            student(page_cur,gid);
        });
    }); 
    </script>
    </body>
</html>