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
    <title>已创建的活动</title>
    <link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/activity/Public/js/uploadify-v3.1/uploadify.css" media="all">
    <link rel="stylesheet" type="text/css" href="/activity/Public/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/activity/Public/css/style.css" />
    <script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
    <script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="/activity/Public/js/bootstrap-datetimepicker.min.js" ></script>
    <script type="text/javascript" src="/activity/Public/js/uploadify-v3.1/jquery.uploadify-3.1.min.js"></script>
    <style>
      .red{color: red;}
      .create_t{margin:30px  10px;}
      .upd_a:hover,.del:hover,.sign_man:hover,.acimg:hover{cursor: pointer;}
      .del{z-index: 99;}
      .ta{display: none;}
      .acimg,.imgsrc{width: 50%;}
      #photo_info{margin-top:15px;width: 50%;}
      #file button div{background: transparent;display: inline;} 
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
            <h3 style="margin-left: 10px;display:none" class="tip">您还没有创建活动哦！</h3>
            <div class="ta">
        <h3 style="margin-left: 10px;" class="table_title">已创建的活动</h3>
        <table class="table table-hover create_t" id="c_table">
          <thead>
            <tr>
              <th>活动id</th>
              <th>活动主题</th>         
              <th>报名情况</th>
              <th>活动状态</th>
              <th>活动人数限制</th>
              
              <th>修改</th> 
              <th>删除</th>
          </tr>
          </thead>
          <tbody class="tbody display" id="table_id_example"></tbody>
        </table>   
        <ul class="pagination" style="margin: 20px 10px;" id="page"></ul>
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
  <!-- 修改活动 {开始-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title ac_name" id="myModalLabel">修改活动</h4>
        </div>
        <form id="expiryForm" style="margin-left: 10px;padding-top:10px;padding-bottom:10px" action="{:U('Index/upd_activity')}" method="post">
        <input type="hidden"  name="acid" class="acid" />
        <div class="modal-body">
          <div class="form-group">
            <span  data-toggle="tooltip" data-placement="right" title="点击更换图片" class="change">
              <img src="" class="imgsrc" />
            </span>                       
          </div>
          <div class="form-group">
            <label for="actitle">活动标题</label>
              <input type="text" class="form-control ac_title" name="actitle" >
          </div>
          <div class="form-group">
            <label for="accontent">活动内容</label>
            <textarea class="form-control ac_content" rows="3" name="accontent"></textarea>
          </div>
       <!--    <div class="form-group">
            <label for="actitle">活动标题</label>
              <input type="text" class="form-control ac_title" name="actitle" >
          </div> -->
          <div class="form-group">
            <label for="accontent">活动人数限制</label>
            <input type="text" class="form-control ac_alimit" name="alimit">
          </div>
          <div class="form-group">
            <label for="actime">活动时间</label>                   
            <input type="text" class="form-control form_datetime ac_time"  name="actime"  >
          </div>
          <div class="form-group">
            <label for="adeadline">活动截止报名时间</label>                   
            <input type="text" class="form-control form_datetime ac_deadline"  name="adeadline"  >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button type="button"  class="btn btn-primary" id="save">保存</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- 修改活动 }结束-->
  <!-- 更换活动图片{开始 -->
  <div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="acname"></h4>
            </div>
            <div class="modal-body">
              <form class="file" method="post" id="file" enctype="multipart/form-data">     
                <input type="file" name="file"  id="info_photo" style="display: none"/>
                  <div onclick="$('input[id=info_photo]').click()" id="change_click">选择图片</div>  
                <input type="hidden" name="acimg" id="acimg">     
              </form>
              <img id="photo_info" class="photo_info" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <!-- <button type="button" class="btn btn-primary" >提交更改</button> -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
  <!-- 更换活动图片}结束 -->

   <script>
    var src='/activity<?php echo ($shead["img"]); ?>_60.jpg';
    $("#member_head").attr('src',src);
    $(".member_name").text('<?php echo ($shead["sname"]); ?>');
    $("#exit").click(function(){
      if (confirm("你确定退出吗？")) {  
        location.href ="<?php echo U('Index/stu_exit');?>";  
      }
    });
    var acimg;//活动图片
    var acname;//活动标题
    var page_cur = 1; //当前页 
    var total_num, page_size, page_total_num;//总记录数,每页条数,总页数
    function pageArea(page_cur,page_total_num){
      var page_str='';
            if (page_cur>page_total_num){page_cur=page_total_num;}
            if (page_cur<1){ page_cur = 1;} //当前页小于1   
            var next="<li><a href='#' onclick='activity(<?php echo ($sid); ?>,"+(parseInt(page_cur)+1)+")'>下一页</a></li>";
            var pre="<li><a href='#' onclick='activity(<?php echo ($sid); ?>,"+(parseInt(page_cur)-1)+")'>上一页</a></li>";
            var first="<li><a href='#' onclick='activity(<?php echo ($sid); ?>,1)'>首页</a></li>";
            var last="<li><a href='#' onclick='activity(<?php echo ($sid); ?>,"+page_total_num+")'>尾页</a></li>";
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
    function activity(sid,page){
      page1=page-1;
      $.ajax({
        type: 'POST', 
        url: '/activity/index.php/home/index/activity_ask', 
        data: "sid="+sid+"&page="+page1, 
        dataType: 'JSON', 
        success: function(json) { 
            $(".tbody").empty(); 
            total_num = json.total_num; //总记录数 
            page_size = json.page_size; //每页数量 
            page_cur = page; //当前页 
            page_total_num = json.page_total; //总页数 
            var data = json.list; 
           if(data){
           	$(".tip").hide();
           	$(".ta").show();
             for(var i=0;i<data.length;i++){
              if(data[i].alimit==0){
                data[i].alimit_text="无限制";
              }else{
                data[i].alimit_text=data[i].alimit;
              }
              var str='<tr>'+
                    '<td  class="acid" acid="'+data[i].acid+'">'+data[i].acid+'</td>'+
                    '<td>'+data[i].actitle+'</td>'+
                    '<td acid="'+data[i].acid+'" total="'+data[i].total+'" class="sign">'+data[i].total_text+'</td>'+
                    '<td>'+data[i].acpublis_text+'</td>'+
                    '<td>'+data[i].alimit_text+'</td>'+
                    '<td  class="upd" acid="'+data[i].acid+'">'+
                    '<span rel="'+data[i].acid+'"  data-toggle="modal" data-target="#myModal">'+
                    '<span class="glyphicon glyphicon-edit upd_a" onclick="upd('+data[i].acid+')"></span></span></td>'+
                    '<td><span onclick="del('+data[i].acid+')"  class="del glyphicon glyphicon-remove-circle red"'+
                    '></span></td></tr>';
               $(".tbody").append(str);
               
            }
            $(".sign").each(function(){
                if($(this).attr("total")>0){
                	$(this).addClass("sign_man");
                	$(this).click(function(){
                		var acid=$(this).attr("acid");
                       window.location="http://localhost/activity/index.php/Home/Index/ac_sign/acid/"+acid;  
                	});
                }
            });
           }else{
           	$(".tip").show();
           	$(".ta").hide();
           }
            
        }, 
        complete: function() {
                var page_str=pageArea(page_cur,page_total_num);
                $("#page").html(page_str);
        }, 
        error: function() { 
            alert("数据异常,请检查是否json格式"); 
        },
      });
    }
    activity(<?php echo ($sid); ?>,page_cur);
    // 删除活动
    function del(acid){
      if (confirm("你确定删除吗？")) { 
          location.href ="http://localhost/activity/index.php/Home/Index/ac_del/acid/"+acid;  
      }else{}
    }
    // 修改活动弹窗
    $('.form_datetime').datetimepicker({
      minView: "month", 
      language:  'zh-CN',
      format: 'yyyy-mm-dd',
      autoclose: 1,
      pickerPosition: "top-left",
    });
    $('#myModal').modal('hide');
    $("[data-toggle='tooltip']").tooltip();  
    function upd(acid){
      var ajaxUrl = "/activity/index.php/home/index/my_detail";
        var ajaxData = "acid=" +acid;
        $.ajax({
          type:"POST",
          url: ajaxUrl,
          data:ajaxData,
          dataType: "JSON",
          success:function(data){
            acimg=data.aimg;
            acname=data.actitle;
            var acsrc='/activity'+acimg;
            $(".imgsrc").attr('src',acsrc);
          $(".ac_title").val(data.actitle);
          $(".ac_alimit").val(data.alimit);
          $(".ac_content").val(data.accontent);
          $(".ac_time").val(data.actime);
          $(".ac_deadline").val(data.adeadline);
          $(".acid").val(data.acid);
          // alert(data.acid);
          $('#myModal').modal();
          },
        });
    }
    //保存修改内容
    $("#save").click(function(){
        var ajaxData = $("#expiryForm").serialize();
        $.ajax({
            type:"POST",
            url:  "/activity/index.php/home/index/upd_activity",
            data:ajaxData,
            dataType: "JSON",
            success:function(data){
                $('#myModal').modal('hide');
                activity(<?php echo ($sid); ?>,page_cur);
            },
        });
    }); 
    $(".change").click(function(){
      $('#myModal').modal('hide');
      $("#acname").html(acname);
      $("#acimg").val(acimg);     
      $('#change').modal();
    });
    $('#change_click').uploadify({
        'swf'      : '/activity/Public/js/uploadify-v3.1/uploadify.swf',
        'uploader' : '<?php echo U("Index/updAcimg");?>',
        'buttonText' : '上传图片',
        'onUploadStart' : function(file) {
          $("#change_click").uploadify("settings", "formData", {'acimg':acimg});
        },
        'onUploadSuccess': function(file, data, response) {
            console.log(data);
            var data = $.parseJSON(data);
            var acsrc='/activity/Avatar/'+data+'.jpg';
            $("#photo_info").attr('src',acsrc);
        },
    });
   // $(function () { $('#change').on('hide.bs.modal', function () {
   //    activity(<?php echo ($sid); ?>,page_cur);})
   // });
</script>
</body>
</html>