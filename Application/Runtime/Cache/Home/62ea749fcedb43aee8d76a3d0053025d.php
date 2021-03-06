<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="/activity/Public/css/jquery.Jcrop.min.css" media="all">
<link rel="stylesheet" type="text/css" href="/activity/Public/js/uploadify-v3.1/uploadify.css" media="all">
<link rel="icon" type="image/png" href="/activity/Avatar/logo.png">
<script type="text/javascript" src="/activity/Public/js/jquery-2.1.3.min.js" ></script>
<script type="text/javascript" src="/activity/Public/js/uploadify-v3.1/jquery.uploadify-3.1.min.js"></script>
<script type="text/javascript" src="/activity/Public/js/jquery.Jcrop.min.js"></script>
<script type="text/javascript" src="/activity/Public/js/ThinkBox/jquery.ThinkBox.js"></script>
<link rel="stylesheet" type="text/css" href="/activity/Public/js/ThinkBox/css/ThinkBox.css" media="all">
<link rel="stylesheet" href="/activity/Public/css/bootstrap.min.css" />
<script type="text/javascript" src="/activity/Public/js/bootstrap.min.js" ></script>
<link rel="stylesheet" href="/activity/Public/css/style.css" />
<title>注册</title>
<style type="text/css">
.main{margin: 20px auto;padding: 15px;width: 750px;font-family: "microsoft yahei";background-color: #F5F5F5;}
.cf:after,.cf:before{display:table;content:"";line-height:0}
.cf:after{clear:both}
.upload-area{position:relative;float:left;margin-right:30px;width:200px;height:200px;background-color:#F5F5F5;border:2px solid #E1E1E1}
.upload-area .file-tips{position:absolute;top:90px;left:0;padding:0 15px;width:170px;line-height:1.4;font-size:12px;color:#A8A8A3;text-align:center}
.userup-icon{display:inline-block;margin-right:3px;width:16px;height:16px;vertical-align:-2px;background:url(/activity/Public/img/userup_icon.png) no-repeat}
.uploadify-button{line-height:120px!important;text-align:center}
.preview-area{float:left}
.tcrop{clear:right;font-size:14px;font-weight:700}
.update-pic .crop{background:url(/activity/Public/img/mystery.png) no-repeat scroll center center #EEE;float:left;margin-bottom:20px;margin-top:10px;overflow:hidden}
.crop100{height:100px;width:100px}
.crop60{height:60px;margin-left:20px;width:60px}
/*.update-pic .save-pic{clear:left;margin-right:20px}*/
.update-pic .uppic-btn{background-color:#348FD4;color:#FFF;display:block;float:left;font-size:16px;height:30px;line-height:30px;text-align:center;vertical-align:middle;width:89px}
.preview{position:absolute;top:0;left:0;z-index:11;width:200px;height:200px;overflow:hidden;background:#fff;display:none}

/*h5{display: inline;padding: 5px;}*/
</style>
</head>
<body>
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
                <form action="<?php echo U('Index/updImg');?>" method="post" id="pic" class="update-pic cf">
                    <div class="upload-area">
                        <input type="file" id="user-pic">
                        <div class="file-tips">支持JPG,PNG,GIF，图片小于1M不小于100*100,真实高清头像更受欢迎！</div>
                        <div class="preview hidden" id="preview-hidden"></div>
                    </div>
                    <div class="preview-area">
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="hidden" id='img_src' name='src'/>
                        <div class="tcrop">头像预览</div>
                        <div class="crop crop100"><img id="crop-preview-100" src="" alt=""></div>
                        <div class="crop crop60">
                            <img id="crop-preview-60" src="" alt="">
                        </div>
                        <div>
                            <a href="javascript:$('#user-pic').uploadify('cancel','*');">
                             <button class="reupload-img btn btn-default">重新上传</button></a>
                        <a class="save-pic" href="javascript:;" style="margin-left:40px;">
                            <button class="btn" style="background:#000;color:#fff">保存</button>
                        </a>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="links_item"><p class="copyright">郭大侠出品</p> </div>
</div>
<script type="text/javascript">
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
  $(function(){
    //上传头像(uploadify插件)
    $("#user-pic").uploadify({
      'queueSizeLimit' : 1,
      'removeTimeout' : 0.5,
      'preventCaching' : true,
      'multi'    : false,
      'swf'       : '/activity/Public/js/uploadify-v3.1/uploadify.swf',
      'uploader'    : '<?php echo U("Index/uploadImg");?>',
      'buttonText'  : '<i class="userup-icon"></i>上传头像',
      'width'     : '200',
      'height'    : '200',
      'fileTypeExts'  : '*.jpg; *.png; *.gif;',
      'onUploadSuccess' : function(file, data, response){
        //调试语句
        console.log(data);

        var data = $.parseJSON(data);
        if(data['status'] == 0){
          $.ThinkBox.error(data['info'],{'delayClose':3000});
          return;
        }
        var preview = $('.upload-area').children('#preview-hidden');
        preview.show().removeClass('hidden');
        //两个预览窗口赋值
        $('.crop').children('img').attr('src',data['path']+'?random='+Math.random());
        //隐藏表单赋值
        $('#img_src').val(data['path']);
        //绑定需要裁剪的图片
        var img = $('<img />');
        preview.append(img);
        preview.children('img').attr('src',data['path']+'?random='+Math.random());
        var crop_img = preview.children('img');
        crop_img.attr('id',"cropbox").show();
        var img = new Image();
        img.src = data['path']+'?random='+Math.random();
        //根据图片大小在画布里居中
        img.onload = function(){
          var img_height = 0;
          var img_width = 0;
          var real_height = img.height;
          var real_width = img.width;
          if(real_height > real_width && real_height > 200){
            var persent = real_height / 200;
            real_height = 200;
            real_width = real_width / persent;
          }else if(real_width > real_height && real_width > 200){
            var persent = real_width / 200;
            real_width = 200;
            real_height = real_height / persent;
          }
          if(real_height < 200){
            img_height = (200 - real_height)/2;
          }
          if(real_width < 200){
            img_width = (200 - real_width)/2;
          }
          preview.css({width:(200-img_width)+'px',height:(200-img_height)+'px'});
          preview.css({paddingTop:img_height+'px',paddingLeft:img_width+'px'});
        }
        //裁剪插件
        $('#cropbox').Jcrop({
                bgColor:'#333',   //选区背景色
                bgFade:true,      //选区背景渐显
                fadeTime:1000,    //背景渐显时间
                allowSelect:false, //是否可以选区，
                allowResize:true, //是否可以调整选区大小
                aspectRatio: 1,     //约束比例
                minSize : [100,100],//可选最小大小
                boxWidth : 200,   //画布宽度
                boxHeight : 200,  //画布高度
                onChange: showPreview,//改变时重置预览图
                onSelect: showPreview,//选择时重置预览图
                setSelect:[ 0, 0, 100, 100],//初始化时位置
                onSelect: function (c){ //选择时动态赋值，该值是最终传给程序的参数！
                  $('#x').val(c.x);//需裁剪的左上角X轴坐标
                  $('#y').val(c.y);//需裁剪的左上角Y轴坐标
                  $('#w').val(c.w);//需裁剪的宽度
                  $('#h').val(c.h);//需裁剪的高度
              }
            });
        //提交裁剪好的图片
        $('.save-pic').click(function(){
          if($('#preview-hidden').html() == ''){
            $.ThinkBox.error('请先上传图片！');
          }else{
            //由于GD库裁剪gif图片很慢，所以长时间显示弹出框
            $.ThinkBox.success('图片处理中，请稍候……',{'delayClose':30000});
            $('#pic').submit();
          }
        });
        //重新上传,清空裁剪参数
        var i = 0;
        $('.reupload-img').click(function(){
          $('#preview-hidden').find('*').remove();
          $('#preview-hidden').hide().addClass('hidden').css({'padding-top':0,'padding-left':0});
        });
         }
    });
    //预览图
    function showPreview(coords){
      var img_width = $('#cropbox').width();
      var img_height = $('#cropbox').height();
        //根据包裹的容器宽高,设置被除数
        var rx = 100 / coords.w;
        var ry = 100 / coords.h;
        $('#crop-preview-100').css({
          width: Math.round(rx * img_width) + 'px',
          height: Math.round(ry * img_height) + 'px',
          marginLeft: '-' + Math.round(rx * coords.x) + 'px',
          marginTop: '-' + Math.round(ry * coords.y) + 'px'
        });
        rx = 60 / coords.w;
        ry = 60 / coords.h;
        $('#crop-preview-60').css({
          width: Math.round(rx * img_width) + 'px',
          height: Math.round(ry * img_height) + 'px',
          marginLeft: '-' + Math.round(rx * coords.x) + 'px',
          marginTop: '-' + Math.round(ry * coords.y) + 'px'
        });
    }
  })

</script>

      
</body>
</html>