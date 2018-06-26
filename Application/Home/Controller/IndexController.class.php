<?php
namespace Home\Controller;

use Think\Controller;
use Think\Upload;
use Vendor\ThinkImage\ThinkImage;

class IndexController extends Controller {

   function _initialize(){
        header("Content-type:text/html;charset=utf-8");
   }
   //首页
    public function index(){       
    	if(empty($_SESSION['snum'])){
            $snum=0;
    	}else{
            $snum=$_SESSION['snum'];
            $this->head($snum);
        }    	
        $time=date('y-m-d',time());
        $data=M("Activity")->select();
        for($i=0;$i<count($data);$i++){
            if(strtotime($data[$i]['adeadline'])<strtotime($time)){
                if($data[$i]['acpublis']==1){
                    $a['acpublis']=3;
                    $a['acid']=$data[$i]['acid'];
                    $b=M('Activity')->save($a);
                }
            }
        }
        $this->assign('snum',$snum);
    	$this->display();
    }
    function index_activity($page){
        $stu=M("Activity")->where('acpublis=1')->count();
        $json['total_num']=$stu;
        $json['page_size']=6; //每页数量 
        $json['page_total']=ceil($json['total_num']/$json['page_size']); //总页数 
        $json['page_start']=$page *$json['page_size'];
        $data=M("Activity")->where('acpublis=1')->limit($json['page_start'],$json['page_size'])->select();
        for($i=0;$i<count($data);$i++){  
            $data[$i]['snickname']=M("Student")->where('sid='.$data[$i]['pid'])->getField('snickname');   
             $data[$i]['sid']=M("Student")->where('sid='.$data[$i]['pid'])->getField('sid');          
        }
        $json['data']=$data;
        $this->ajaxReturn($json);
    }
   //报名
    public function signUp($acid,$snum){
        $flag=true;
        if($snum!=0){
            $alimit=M('Activity')->where('acid='.$acid)->getField('alimit');
            $ali=intval($alimit);
            $anum=M("Activity_sudent")->where('acid='.$acid)->count();
            $a2=intval($anum);
            if($ali>0&&$a2==$ali){              
                $su=3;
            }else{
                $param['sid']=M("Student")->where('snum='.$snum)->getField('sid');
            $param['acid']=$acid;
            $a=M("Activity_sudent")->where($param)->find();
            if($a!=null){
                    $su=0;
                }else{
                    //活动时间判断
                    $actime=M('Activity')->where('acid='.$acid)->getField('actime');
                    $signAcid=M('Activity_sudent')->where('sid='.$param['sid'])->select();
                    for($i=0;$i<count($signAcid);$i++){
                        $time[$i]=D('Activity')->where('acid='.$signAcid[$i]['acid'])->getField('actime');
                        if($actime==$time[$i]){
                            $su=4;
                            $flag=false;
                        }
                    }  
                    if($flag){
                        $result=M('Activity_sudent')->add($param);
                        if($result){
                            $su=1;
                        }                     
                    }               
                }
            }
        }else{
            $su=2;
        }
        $this->ajaxReturn($su);
    }
    function s(){
        $snum=3;
        $flag=true;
        $acid=15;
        if($snum==0){
          $su=2;
        }else{
            // $su=1;
            $alimit=M('Activity')->where('acid='.$acid)->getField('alimit');
            $ali=intval($alimit);
            $anum=M("Activity_sudent")->where('acid='.$acid)->count();
            $a2=intval($anum);
                if($alimit>0&&$anum==$alimit){//当报名该活动的人数满时
                $su=3;
               }else{
                $actime=M('Activity')->where('acid='.$acid)->getField('actime');
                    $sign_acid=M('Activity_sudent')->where('sid='.$snum)->select();
                    for($i=0;$i<count($sign_acid);$i++){
                        $time[$i]=M('Activity')->where('acid='.$sign_acid[$i]['acid'])->getField('actime');
                    }        
                    for($j=0;$j<count($time);$j++){
                       if($actime==$time[$j]){
                            $su=6;
                            $flag=false;
                        }
                    }
                    if($flag){
                       $su=1;
                    }  
                      
               }
        }
        var_dump($flag);
        echo $su;
    }
    // 活动详情
    function detail(){
    	$data=M("Activity")->where('acid='.I('acid'))->find();
        $data['sname']=M("Student")->where('sid='.$data['pid'])->getField('sname');
        // var_dump($data);
        $this->ajaxReturn($data,"JSON");
    }
    //退出模块
    function stu_exit(){
    	unset($_SESSION['snum']);
        jump(U('Index/index'));
       //  $this->success("退出成功");
    }   
    //注册模块
    public function register(){
        $list=M('Grade')->select();
        $this->assign('list',$list);
    	$this->display();
    }
    //验证学号是否注册过
    function snum_v(){
        $snum=I("snum");
        $result=M("Student")->where('snum='.$snum)->find();
        if($result){
            $data = 'yes';
        }else{
            $data = 'no';          
        }
        $this->ajaxReturn($data);
    }
    //验证昵称是否用过
    function snickname_v(){
        $snickname['snickname']=I("snickname");

        $result=D("Student")->where($snickname)->find();
        if($result){
            $data = 'yes';           
        }else{
            $data = 'no';
        }
        $this->ajaxReturn($data);
    }
	//上传头像
	public function uploadImg(){
		$upload = new Upload(C('UPLOAD_CONFIG'));	// 实例化上传类
		//头像目录地址
		$path = './Avatar/';
		if(!$upload->upload()) {						// 上传错误提示错误信息
			$this->ajaxReturn(array('status'=>0,'info'=>$upload->getErrorMsg()));
		}else{											// 上传成功 获取上传文件信息
			$temp_size = getimagesize($path.'temp.jpg');
			if($temp_size[0] < 100 || $temp_size[1] < 100){//判断宽和高是否符合头像要求
				$this->ajaxReturn(array('status'=>0,'info'=>'图片宽或高不得小于100px！'));
			}
			$this->ajaxReturn(array('status'=>1,'path'=>__ROOT__.'/Avatar/'.'temp.jpg'));
		}
	}
	//裁剪并保存用户头像
	public function cropImg(){
		//图片裁剪数据
		$params = I('post.');				//裁剪参数
		if(!isset($params) && empty($params)){
			$this->error('参数错误！');
		}

		//头像目录地址
		$path = './Avatar/';
		//要保存的图片
		$real_path = $path.$params['snum'].'.jpg';
		//临时图片地址
		$pic_path = $path.'temp.jpg';
		//实例化裁剪类
		$Think_img = new ThinkImage(THINKIMAGE_GD);
		//裁剪原图得到选中区域
		$Think_img->open($pic_path)->crop($params['w'],$params['h'],$params['x'],$params['y'])->save($real_path);
		//生成缩略图
		$Think_img->open($real_path)->thumb(100,100, 1)->save($path.$params['snum'].'_100.jpg');
		$Think_img->open($real_path)->thumb(60,60, 1)->save($path.$params['snum'].'_60.jpg');
		$Think_img->open($real_path)->thumb(30,30, 1)->save($path.$params['snum'].'_30.jpg');
		    
        $params['shead']=$path.$params['snum'];   
        $a=M("Student")->data($params)->add();  
        if($a){           
            session_start();
            session('snum',$params['snum']);
            jump(U('Index/index'));
        }
	}	
   //登录模块
    public function login(){
       $this->display();
    }
    //检查登录
    function check_login(){  	    
        $snum=I('username');  
        $pwd=I('password');;  
        $date=M("Student")->where('snum='.$snum)->find();
        if($date['spwd']!=$pwd){
            $a=0;
        	$this->ajaxReturn($a);
        }else{
        	session_start();
        	session('snum',$snum);
            $shead['snum']=$snum;
            $shead['img']=M("Student")->where('snum='.$snum)->getField('shead');
            $shead['sname']=M("Student")->where('snum='.$snum)->getField('snickname');
            $this->ajaxReturn($shead);
        }       
    }
    //检查是否已登录
    function check_logined(){
        session_start();
        $user=M('Student');
        $condition['snum']=$_SESSION['snum'];
        $us=$user->where($condition)->find();
        if(!$us){
            jump(U('Index/login'));
        }
    }
    //已创建的活动
    public function has_create(){
    	$snum=$_SESSION['snum'];
        $this->head($snum);
    	$sid=M("Student")->where('snum='.$snum)->getField('sid');
        $this->assign('sid',$sid);
    	$this->display();
    }
    // 活动的具体报名情况
    function ac_sign($acid){
        $snum=$_SESSION['snum'];
        $this->head($snum);
        $this->acid=$acid;
        $this->display();
    }
    function ac_sign_data(){
        $acid=I("acid");
        $page=I("page");
        $stu=M("Activity_sudent")->where('acid='.$acid)->count();
        $json['total_num']=$stu;
        $json['page_size']=5; //每页数量 
        $json['page_total']=ceil($json['total_num']/$json['page_size']); //总页数 
        $json['page_start']=$page *$json['page_size'];
        $data=M("Activity_sudent")->where('acid='.$acid)->limit($json['page_start'],$json['page_size'])->select();
        for($i=0;$i<count($data);$i++){  
            $ta=M("Student")->where('sid='.$data[$i]['sid'])->select();
            foreach($ta as $k=>$v){
                foreach ($v as $key => $val){
                    $data[$i][$key]=$val;
                    $data[$i]['sgrade']=M('Grade')->where($data[$i]['gid'])->getField('grade');
                }
            }
        }
   
        $json['list']=$data;
        $this->ajaxReturn($json);
    }   
    //查询活动
   function activity_ask(){
        $sid=I("sid");
        $page=I("page");
        $ac=M("Activity")->where('pid='.I("sid"))->count();
        $json['total_num']=$ac;
        // $json['total_num']=count($ac);
        $json['page_size']=5; //每页数量 
        $json['page_total']=ceil($json['total_num']/$json['page_size']); //总页数 
        $json['page_start']=$page *$json['page_size'];
        $data=M("Activity")->where('pid='.I("sid"))->limit($json['page_start'],$json['page_size'])->select();
        if($data){    
            for($i=0;$i<count($data);$i++){
                $ac_sign=M('Activity_sudent')->where('acid='.$data[$i]['acid'])->select();
                $data[$i]['total']=count($ac_sign);
                if($data[$i]['total']==0){ $data[$i]['total_text']="还没有人报名";}
                else{$data[$i]['total_text']=$data[$i]['total']+"人报名";}
                switch ($data[$i]['acpublis']) {
                    case 0:
                        $data[$i]['acpublis_text']="未审核";
                        break;
                    case 1:
                        $data[$i]['acpublis_text']="已上线";
                        break;
                    case 2:
                        $data[$i]['acpublis_text']="审核失败";
                        break;                  
                    default:
                        $data[$i]['acpublis_text']="已下线";
                        break;
                }
               
            }
            
            $json['list']=$data;
           $this->ajaxReturn($json);
        }else{
           $this->ajaxReturn("0");
        }      
    }

    // 修改活动
    public function upd_activity(){
        $params = I('post.');
        
        if(!empty($_POST)){
            $params['acpublis']=1;
            $activity=D("Activity"); 
            $activity->create();

            $rst=$activity->save();
            if($rst){

                $this->ajaxReturn($params,"JSON");
            }else{
                // $this->ajaxReturn($activity->getError());
            }
        }        
    }
    //修改活动图片
    function updAcimg(){
        $params=I('post.');
        if(!isset($params) && empty($params)){
            $this->error('参数错误！');
        }
        $path = './Avatar/';  //图片目录地址
        $acimg=I("acimg");
        unlink($acimg);
        $acimg=substr($acimg, 9);
        $acimg=substr($acimg,0,-4);
        $upload = new Upload(C('UPLOAD_CONFIG'));
            // 实例化上传类
        $upload->saveName=$acimg;
        if(!$upload->upload()){                        // 上传错误提示错误信息
            $this->ajaxReturn(array('status'=>0,'info'=>$upload->getErrorMsg()));
        }else{                                          // 上传成功 获取上传文件信息
            // $temp_size = getimagesize($path.$acimg);
            // $a=I('acimg');
            $this->ajaxReturn($acimg);
        }
        
    }
    //删除活动
    function ac_del($acid){
       $ac=M("Activity")->where('acid='.$acid)->delete(); 
       $b=M('Activity_sudent')->where('acid='.$acid)->select();
       if($b){
        M('Activity_sudent')->where('acid='.$acid)->delete(); 
       }
       if($ac){
            $this->success('删除活动成功',U('Index/has_create'));
       }else{
        $this->error(U('删除活动失败','Index/has_create'));
       }
    }
    //具体活动细节
    function my_detail(){
        $activity=M("Activity")->where('acid='.I('acid'))->find();
        $activity['acnum']=M('Activity_sudent')->where('acid='.I('acid'))->count();
        $this->ajaxReturn($activity,"JSON");
    }
    //已参与活动
    public function has_signup(){
       $snum=$_SESSION['snum'];
       $this->head($snum);
       $sid=M("Student")->where('snum='.$snum)->getField('sid');
       $this->assign('sid',$sid);
        $this->display();
    }
    function signup_activity($sid,$page){
        $stu=M("Activity_sudent")->where('sid='.$sid)->count();
        $json['total_num']=$stu;
        $json['page_size']=5; //每页数量 
        $json['page_total']=ceil($json['total_num']/$json['page_size']); //总页数 
        $json['page_start']=$page *$json['page_size'];
        // $data=M("Activity_sudent")->where('acid='.$acid)->limit($json['page_start'],$json['page_size'])->select();
       $activity=M("Activity_sudent")->where('sid='.$sid)->limit($json['page_start'],$json['page_size'])->select();
       $ac=count($activity);
        if(count($activity)!=0){
            for($i=0;$i<count($activity);$i++){
                $a=M('Activity')->where('acid='.$activity[$i]['acid'])->select();
                foreach ($a as $key) {
                    $data[$i]=$key;
                    $data[$i]['acman']=M('Student')->where('sid='.$data[$i]['pid'])->getField('sname');
                    $data[$i]['flag']=$activity[$i]['flag'];
                }   
            }
        }else{
            $data=0;
        }
        $json['list']=$data;
        $this->ajaxReturn($json);
    }
    function cancel_activity($sid,$acid){

       $result=M("Activity_sudent")->where('acid='.$acid.' and sid='.$sid)->delete(); 
       $this->ajaxReturn($result);
    }
//  个人信息修改
    public function update(){
     	$this->check_logined();  	    	
     	if(!empty($_POST)){
     		$student=D("Student"); 
     		$student->create();
			$rst=$student->save();
			if($rst){
                jump(U("Index/has_create"));
			}else{
				var_dump($student->getError());
			}
     	}
     }
    function upd(){
     	$snum=$_SESSION['snum'];
        $this->head($snum);
    	$this->data=M("Student")->where('snum='.$snum)->find();
        $list=M('Grade')->select();
        $this->assign('list',$list);
    	$this->display();
    }
	function head_upd(){
        $snum=$_SESSION['snum'];
        $this->head($snum);
        $this->display();
    }
    //修改头像
	public function updImg(){
		//图片裁剪数据
        $params = I('post.');                       //裁剪参数
        if(!isset($params) && empty($params)){
            $this->error('参数错误！');
        }
        $snum=$_SESSION['snum'];
        //头像目录地址
        $path = './Avatar/';
        //要保存的图片
        $real_path = $path.$snum.'.jpg';
        //临时图片地址
        $pic_path = $path.'temp.jpg';
        //实例化裁剪类
        $Think_img = new ThinkImage(THINKIMAGE_GD);
        //裁剪原图得到选中区域
        $Think_img->open($pic_path)->crop($params['w'],$params['h'],$params['x'],$params['y'])->save($real_path);
        //生成缩略图
        $Think_img->open($real_path)->thumb(100,100, 1)->save($path.$snum.'_100.jpg');
        $Think_img->open($real_path)->thumb(60,60, 1)->save($path.$snum.'_60.jpg');
        $Think_img->open($real_path)->thumb(30,30, 1)->save($path.$snum.'_30.jpg');
         // $this->success('上传头像成功');
         jump(U('Index/has_create'));
       
	}
	//创建活动
	public function activity(){
       $snum=$_SESSION['snum'];
       $this->head($snum);
		$this->display();
	}
	//创建活动操作
	function create_activity(){
		$params = I('post.');				//裁剪参数
		if(!isset($params) && empty($params)){
			$this->error('参数错误！');
		}
        //图片目录地址
        $path = './Avatar/';
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     $path; 
        $upload->autoSub =false;// 设置附件上传根目录
        // 上传文件 
        $info   =   $upload->upload();
        $params['aimg']=$path.$info['aimg']['savename']; 
		session_start();
		$snum=$_SESSION['snum'];
		$params['pid']=M("Student")->where('snum='.$snum)->getField('sid');
        $params['actime']= date("Y-m-d",strtotime($params['actime']));  
        $a=M("Activity")->data($params)->add();  
        if($a){jump(U('Index/has_create'));}
	}
   //登录头像
    function head($snum){
       $shead['img']=M("Student")->where('snum='.$snum)->getField('shead');
       $shead['sname']=M("Student")->where('snum='.$snum)->getField('snickname');
        $this->assign('shead',$shead);
    }
    //学生信息
    function stu(){
        $sid=I("sid");
        $stu=M("Student")->where('sid='.$sid)->find();
        $stu['sgrade']=M('Grade')->where($stu['gid'])->getField('grade');
        $this->ajaxReturn($stu);
    }
    //审核学生
    function stu_check($sid,$acid,$flag){
        $acs=M("Activity_sudent");
        $acs->flag=$flag;
        $condition['sid']=$sid;
        $condition['acid']=$acid;
        $success=$acs->where($condition)->save();
        $this->ajaxReturn($success);
    }
    //修改密码
    function pwd_upd(){
      $snum=$_SESSION['snum'];
       $this->head($snum);
    $this->display();
    }
    function pwd(){
        $condition['spwd']=I("password1");
        $a['new']=I("password2");
        $condition['snum']=$_SESSION['snum'];
        $b=M("Student")->where($condition)->find();
        $condition['sid']=$b['sid'];
        $flag=0;
        if($b){
           $stu=M('Student');
           $stu->spwd=$a['new'];
           $bc=$stu->where($condition)->save();
           if($bc){$flag=2;}else{$flag=1;}
        }else{
            $flag=0;
        }
       $this->ajaxReturn($flag);
    }
}