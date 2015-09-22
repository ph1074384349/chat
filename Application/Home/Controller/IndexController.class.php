<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

	/*初始化*/
	function _initialize(){
		CheckLogin(); //检查用户是否登录
	}

	/*首页*/
    public function index(){
        $this->display();
    }
}