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
		<title>华广校园活动组队平台</title>
		<link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/activity/Public/css/style.css" />
		<script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
		<script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
        <style type="text/css">
            .body{background: #fff;}
            .check:hover,.acid:hover{cursor: pointer;}
            .has_check{display: none!important;}
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
            <h3 style="display:inline">已审核的活动</h3>    
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" 
                    data-toggle="dropdown">查询<span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" class="ac_all">全部</a></li>
                    <li><a href="#" class="ac_1">已上线</a></li>
                    <li><a href="#" class="ac_3">已下线</a></li>
                    <li><a href="#" class="ac_2">审核不通过</a></li>
                </ul>
            </div> 
            <div class="ac">
                <div class="checked" style="margin-top:20px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>活动id</th>
                            <th>活动主题</th>
                            <th>活动创办人</th> 
                            <th>活动人数限制</th>
                            <th>活动报名人数</th>         
                            <th>活动状态</th>
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
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title ac_name" id="myModalLabel">活动详情</h4>
                </div>
                <div class="modal-body">
                    <img class="ac_img" style="width:50%" />                  
                   <table class="table ac_detail">
                       <tr><td style="width: 120px;">活动内容</td><td class="ac_connent"></td></tr>
                       <tr><td>活动人数限制</td><td class="ac_limit"></td></tr>
                       <tr><td>活动报名人数</td><td class="ac_num"></td></tr>
                       <tr><td>活动时间</td><td class="ac_time"></td></tr>
                       <tr><td>截止报名时间</td><td class="ac_deadline"></td></tr>
                   </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    function activity(page,type){
        var page1=page-1;
        $.ajax({
            type:"POST",
            url:"/activity/index.php/admin/index/checked",
            data:"page=" +page1+'&type='+type,
            dataType: "JSON",
            success:function(json){

                    total_num = json.total_num; //总记录数 
                    page_size = json.page_size; //每页数量 
                    page_cur = page; //当前页 
                    page_total_num = json.page_total; //总页数 
                    var data = json.list; 
                    console.log(data);
                    $(".tbody").empty();
                    if(data){
                        $(".ac").show();
                       $(".no_ac").hide();
                        $.each(data,function(index,obj){
                            if(obj.acpublis==0){obj.acpublis_text="未审核";}
                            else if(obj.acpublis==1){obj.acpublis_text="已上线";}
                            else if(obj.acpublis==2){obj.acpublis_text="审核不通过";}
                            else{obj.acpublis_text="已下线";}
                            var acnum_text,aclimit_text;
                            if(obj.alimit>0){
                                aclimit_text=obj.alimit;
                            }else{
                                aclimit_text="没有人数限制";
                            }
                            if(obj.anum>0){
                                acnum_text=obj.anum;
                            }else{
                                acnum_text="还没有人报名";
                            }
                            var str='<tr>'+
                                                                         
                                '<td class="acid" acid="'+obj.acid+'"><span  data-toggle="tooltip" data-placement="right" title="点击查看详情"><span rel="'+obj.acid+'" data-toggle="modal" data-target="#myModal">'+obj.acid+'</span></span></td>'+
                                    '<td>'+obj.actitle+'</td>'+
                                    '<td>'+obj.sname+'</td>'+
                                    '<td>'+aclimit_text+'</td>'+
                                    '<td>'+acnum_text+'</td>'+
                                    '<td>'+obj.acpublis_text+'</td>'+
                                    '</tr>';
                            $(".tbody").append(str);
                        });

                         $("[data-toggle='tooltip']").tooltip();
                        $(".acid").each(function(){
                          $(this).click(function(){
                            detail($(this).attr("acid"));
                          });
                      });
                    }else{

                       $(".ac").hide();
                       $(".no_ac").show();
                       $(".no_ac").empty();
                       var text;
                       if(type==0){
                        text="目前没有审核过的活动";
                       }else if(type==1){
                         text="目前没有上线的活动";
                       }else if(type==2){
                        text="目前没有审核不通过的活动";
                       }else{
                        text="目前没有下线的活动";
                       }
                       $(".no_ac").html(text);
                    }
                    
                    },
            complete: function() {
                        var page_str=pageArea(page_cur,page_total_num);
                        $("#page").html(page_str);
                      }, 

        });
    }
    activity(page_cur,0);
     $(".ac_no").click(function(){
        check_result($(this).attr('acid'),2);
     });
     $(".ac_yes").click(function(){
        check_result($(this).attr('acid'),1);
     });
     $(".ac_all").click(function(){
        activity(page_cur,0);
     });
     $(".ac_1").click(function(){
        activity(page_cur,1);
     });
     $(".ac_2").click(function(){
        activity(page_cur,2);
     });
     $(".ac_3").click(function(){
        activity(page_cur,3);
     });
      $('#myModal').modal('hide');
        function detail(acid){
            $.ajax({
                type:"POST",
                url:"/activity/index.php/admin/index/my_detail",
                data:"acid=" +acid,
                dataType: "JSON",
                success:function(data){
                    var acnum_text,aclimit_text;
                            if(data.alimit>0){
                                aclimit_text=data.alimit;
                            }else{
                                aclimit_text="没有人数限制";
                            }
                            if(data.anum>0){
                                acnum_text=data.anum;
                            }else{
                                acnum_text="还没有人报名";
                            }
                    var ac_src='/activity'+data.aimg;
                    $(".ac_img").attr('src',ac_src); 
                    $(".ac_name").text(data.actitle);
                    $(".ac_connent").html(data.accontent);
                    $(".ac_time").html(data.actime);
                    $(".ac_limit").html(aclimit_text);
                    $(".ac_num").html(acnum_text);
                    $(".ac_deadline").html(data.adeadline);
                    $('#myModal').modal();
                },
           }); 
         }
        
    </script>
    </body>
</html>