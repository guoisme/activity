<?php
namespace Home\Controller;

use Think\Controller;
use Think\Upload;
use Vendor\ThinkImage\ThinkImage;

class PublicController extends Controller {
   public function navbar(){
   	$this->display();
   }
   public function footer(){
   	$this->display();
   }
   public function head(){
   	$this->display();
   }
}
?>