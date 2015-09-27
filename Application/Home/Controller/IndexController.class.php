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
    	$this->User = new \Home\Model\UserModel();$this->User = new \Home\Model\UserModel();
    	$where['user_id'] = array('neq',session('user_id'));//搜索条件
<<<<<<< HEAD
        $data = $this->User->where($where)->relation(true)->select();
=======
        $data = $this->User->where($where)->relation(true)->find();
>>>>>>> origin/master
        $this->data = $data;
        $this->display();
    }
}