<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Upload;
use Vendor\ThinkImage\ThinkImage;

class PublicController extends Controller {
   public function footer(){
   	$this->display();
   }
   public function head(){
   	$this->display();
   }
}
?>