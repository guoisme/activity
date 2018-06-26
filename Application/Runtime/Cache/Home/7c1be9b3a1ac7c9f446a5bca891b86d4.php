<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="guo">
		<title>已报名的活动</title>
    <link rel="icon" type="image/png" href="/activity/Avatar/logo.png">
		<link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/activity/Public/css/style.css" />
		<script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
		<script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
    
		<style>
			.red{color: red;}
			.create_t{margin:30px  10px;}
			.upd_a:hover,.del_a:hover,.acid:hover,.del:hover{cursor: pointer;}
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
        <h3 style="margin-left: 10px;display:none" class="tip">您还没有报名活动哦！</h3>
        <div class="ta">
				<h3 style="margin-left: 10px;" class="table_title">已报名的活动</h3>
				<table class="table table-hover create_t">
          <thead>
            <tr>
              <th>活动id</th>
              <th>活动主题</th>
              <th>活动创办人</th>          
              <th>报名情况</th>
              <th>活动状态</th>
              <th>取消报名</th>
            </tr>
          </thead>
          <tbody class="tbody"></tbody>
            
               
        </table>                
        <ul class="pagination" id="page" style="margin: 20px 10px;"></ul>
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
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>
    <script>
 		    
    		var a="sss";
        var page_cur = 1; //当前页 
        var total_num, page_size, page_total_num;//总记录数,每页条数,总页数
        function pageArea(page_cur,page_total_num){
      var page_str='';
            if (page_cur>page_total_num){page_cur=page_total_num;}
            if (page_cur<1){ page_cur = 1;} //当前页小于1   
            var next="<li><a href='#' onclick='signup_activity(<?php echo ($sid); ?>,"+(parseInt(page_cur)+1)+")'>下一页</a></li>";
            var pre="<li><a href='#' onclick='signup_activity(<?php echo ($sid); ?>,"+(parseInt(page_cur)-1)+")'>上一页</a></li>";
            var first="<li><a href='#' onclick='signup_activity(<?php echo ($sid); ?>,1)'>首页</a></li>";
            var last="<li><a href='#' onclick='signup_activity(<?php echo ($sid); ?>,"+page_total_num+")'>尾页</a></li>";
            if(page_cur==1){
              page_str+=next+last; 
            }else if(page_cur>= page_total_num){
              page_str+=first+pre;
            }else{
              page_str+=first+next+pre+last;
            }
            if(page_total_num==1){page_str='';} 
            // $("#page").html(page_str);
            return page_str;
}
         $('#myModal').modal('hide');
         function activity(acid){
            $.ajax({
                     type:"POST",
                     url:"/activity/index.php/home/index/my_detail",
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
        function signup_activity(sid,page){
          page1=page-1;
          $.ajax({
              type:"POST",
              url: "/activity/index.php/home/index/signup_activity",
              data:'sid='+sid+'&page='+page1,
              dataType: "JSON",
              success:function(json){
                      total_num = json.total_num; //总记录数 
                      page_size = json.page_size; //每页数量 
                      page_cur = page; //当前页 
                      page_total_num = json.page_total; //总页数 
                      var data = json.list; 
                      $(".tbody").empty();
                     if(data!=0){
                        $.each(data,function(index,obj){
                        if(obj.flag==0){obj.flag_text="未审核";}else if(obj.flag==1){obj.flag_text="报名成功";}else{obj.flag_text="报名失败";}
                        if(obj.acpublis==0){obj.ap_text="未审核"}
                          else if(obj.acpublis==1){obj.ap_text="已上线";}
                          else if(obj.acpublis==2){obj.ap_text="审核失败";}
                          else{obj.ap_text="已下线";}

                         var str='<tr>'+                                         
                                '<td class="acid" acid="'+obj.acid+'"><span  data-toggle="tooltip" data-placement="right" title="点击查看详情"><span rel="'+obj.acid+'" data-toggle="modal" data-target="#myModal">'+obj.acid+'</span></span></td>'+
                                  '<td>'+obj.actitle+'</td>'+
                                  '<td>'+obj.acman+'</td>'+
                                  '<td>'+obj.flag_text+'</td>'+
                                 '<td>'+obj.ap_text+'</td>'+
                                 '<td class="del"><span onclick="del('+obj.acid+')" class="del glyphicon glyphicon-remove-circle red"></span></td>'+
                                 +'</tr>';
                          $(".tbody").append(str);
                      });
                      $(".acid").each(function(){
                          $(this).click(function(){
                            activity($(this).attr("acid"));
                          });
                      });
                      $("[data-toggle='tooltip']").tooltip();
                     }else{
                      $(".ta").hide();
                      $(".tip").show();
                     }
                     
                      },
              complete: function() {
                        var page_str=pageArea(page_cur,page_total_num);
                        $("#page").html(page_str);
                      }, 
                      
           });
         }
         signup_activity(<?php echo ($sid); ?>,page_cur);
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
        function  del(acid){
          if (confirm("你确定删除吗？")){
            $.ajax({
              type:"POST",
              url: "/activity/index.php/home/index/cancel_activity",
              data:'sid='+<?php echo ($sid); ?>+'&acid='+acid,
              dataType: "JSON",
              success:function(json){
                console.log(json);               
                signup_activity(<?php echo ($sid); ?>,page_cur);
                if(json>0){
                  alert("已取消报名");
                }else{
                  alert("取消报名失败");
                }
              }
             });
          }else{}
        }
    </script>
    </body>
</html>