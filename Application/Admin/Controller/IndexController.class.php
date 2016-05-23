<?php
namespace Admin\Controller;
use Think\Controller;
use \Admin\Common\CommonController;
class IndexController extends CommonController {
    public function index(){
        $this->display();
    }
}