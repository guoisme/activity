<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller {

   function _initialize(){
        header("Content-type:text/html;charset=utf-8");
   }
   //首页
    public function index(){
        $this->check_logined();
    	$this->display();
    }
    //登录
    public function login(){
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
        $this->display();
    }
    function check_login(){
        $username=I("username");
        $password=I("password");
        $date=M("Admin")->where('aname='.$username)->find();
        if($date['apwd']!=$pwd){
            $a=false;
            $this->ajaxReturn($a);
        }else{
            session_start();
            session('username',$username);
            $a=true;
            $this->ajaxReturn($a);
        }     
    }
    //检查是否已登录
    function check_logined(){
        session_start();
        $user=M('Admin');
        $condition['aname']=$_SESSION['username'];
        $us=$user->where($condition)->find();
        if(!$us){
            jump(U('Index/login'));
        }
    }
    //退出
    function admin_exit(){
        unset($_SESSION['username']);
        jump(U('Index/login'));
    }
    //审核活动
    function check_activity(){
        $page=I("page");
        $num=M("Activity")->where('acpublis=0')->count();
        $json['total_num']=$num;
        $json['page_size']=5; //每页数量 
        $json['page_total']=ceil($json['total_num']/$json['page_size']); //总页数 
        $json['page_start']=$page *$json['page_size'];
       $activity=M("Activity")->where('acpublis=0')->limit($json['page_start'],$json['page_size'])->select();
       $ac=count($activity);
        if(count($activity)>0){
            for($i=0;$i<$ac;$i++){         
             $activity[$i]['sname']=M('Student')->where('sid='.$activity[$i]['pid'])->getField('sname');
            }
            
             $json['list']=$activity;
        }else{
            $json['list']=false;
        }
        $this->ajaxReturn($json);
    }
    function check(){
        $acid=I("acid");
        $data=M("activity")->where('acid='.$acid)->find();
        $this->ajaxReturn($data);
    }
    function check_result(){
        $a['acid']=I("acid");
        $flag=I("flag");
        if($flag==1){
            $a['acpublis']=1;
        }else{
            $a['acpublis']=2;
        }
        $result=M('Activity')->save($a);
        if($result){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //已审核的活动
    function has_check(){
        $this->check_logined();
        $this->display();
    }
    function my_detail(){
        $activity=M("Activity")->where('acid='.I('acid'))->find();
        $activity['anum']=M('Activity_sudent')->where('acid='.I('acid'))->count();
        $this->ajaxReturn($activity,"JSON");
    }
    function checked(){
        $page=I("page");
        $type=I("type");
        if($type==0){           
            $a['acpublis']=array('neq',0);
        }else if($type==1){
            $a['acpublis']=1;
         }else if($type==2){
            $a['acpublis']=2;
        }else if($type==3){
            $a['acpublis']=3;
        }
        $num=M("Activity")->where($a)->count();
        $json['total_num']=$num;
        $json['page_size']=5; //每页数量 
        $json['page_total']=ceil($json['total_num']/$json['page_size']); //总页数 
        $json['page_start']=$page *$json['page_size'];
       $activity=M("Activity")->where($a)->limit($json['page_start'],$json['page_size'])->select();
       $ac=count($activity);
        if(count($activity)!=0){
            for($i=0;$i<$ac;$i++){         
            $activity[$i]['sname']=M("Student")->where('sid='.$activity[$i]['pid'])->getField("sname");
            $activity[$i]['anum']=M('Activity_sudent')->where('acid='.$activity[$i]['acid'])->count();
            }
             $json['list']=$activity;
        }else{
            $json['list']=false;
        }
        $this->ajaxReturn($json);
    }
    // 管理学生
    function stu_manage(){
        $this->check_logined();
        $list=M('Grade')->select();
        $this->assign('list',$list);
        $this->display();
    }
    function student(){
         $page=I("page");
         $gid=I("gid");
         if($gid==0){
             $num=M("Student")->count();          
         }else{
            $num=M("Student")->where('gid='.$gid)->count();  
         }        
        $json['total_num']=$num;
        $json['page_size']=10; //每页数量 
        $json['page_total']=ceil($json['total_num']/$json['page_size']); //总页数 
        $json['page_start']=$page *$json['page_size'];
        if($gid==0){  
             $student=M("Student")->limit($json['page_start'],$json['page_size'])->select();
        }else{
           $student=M("Student")->where('gid='.$gid)->limit($json['page_start'],$json['page_size'])->select();
        }
        $count=count($student);
        for($i=0;$i<$count;$i++){
            $student[$i]['sgrade']=M("Grade")->where('gid='.$student[$i]['gid'])->getField('grade');
        }
        $json['list']=$student;
        $this->ajaxReturn($json);
    }
    function upd_stu(){
        $sid=I('sid');
        $student=M("student")->where('sid='.$sid)->find();
        $student['sgrade']=M('Grade')->where('gid='.$student['gid'])->getField('grade');
        $this->ajaxReturn($student);
    }
    function delStu(){
       $a=I('sid');
       $shead=M("Student")->where('sid='.$a)->getField('shead');
       unlink($shead.'_30.jpg');unlink($shead.'_60.jpg');unlink($shead.'_100.jpg');
       unlink($shead.'.jpg');
       $student=M("Student")->delete($a);
       $b=M("Activity_student")->where('sid='.$a)->select();
       if($b){
          M("Activity_student")->where('sid='.$a)->delete();
       }
       if($student){
         $this->ajaxReturn($student);
       }
    }
    function saveStu(){
        $params=I('post');
        $student=D("Student");
        if(!empty($_POST)){
            $student->create();
            $result=$student->save();
            if($result){
                $this->ajaxReturn($params,"JSON");
            }else{
                $this->ajaxReturn($student->getError());
            }
             
        }
    }
    //管理年级
    function grade_manage(){
        $this->check_logined();
        $this->display();
    }
    //添加年级
    function addGrade(){
        $data['grade']=I('grade');
        $result=M("Grade")->add($data);
        $this->ajaxReturn($data);
    }
    function grade(){
        $data=M('Grade')->select();
        $this->ajaxReturn($data);
    }
    function delGrade(){
       $gid=I('gid');
       $result=M("Grade")->delete($gid); 
       if($result){
         $data='yes';
       }else{
        $data='no';
       }
       $this->ajaxReturn($data);
    }
    //修改年级
    function upd_grade(){
        $gid=I("gid");
        $result=M("Grade")->where('gid='.$gid)->find();
        $this->ajaxReturn($result);
    }
    function updGrade(){
      $params = I('post.');
        if(!empty($_POST)){
            $grade=D("Grade"); 
            $grade->create();
            $rst=$grade->save();
            if($rst){
                $this->ajaxReturn($params,"JSON");
            }
        }  
    }
    function text(){
        $data['gid']=2;
        $data['sid']=2;
        $data['spwd']='ss';
        $re=M("Student")->save($data);
        echo $re;
    }
}