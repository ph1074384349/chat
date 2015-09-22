<?php
/*
* 用户类
*/
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

    /*初始化*/
    function _initialize(){
        CheckLogin(); //检查用户是否登录
        $this->User = new \Home\Model\UserModel();
    }

    /*个人中心*/
    public function personal(){
        $this->display();
    }

    /*个人资料*/
    public function info(){
        $where['sp_users_login.user_en_id'] = session('user_en_id');
        //$data = $this->User->where($where)->join('LEFT JOIN sp_users_profile ON sp_users_login.user_id = sp_users_profile.uid')->find();
        $data = $this->User->where($where)->relation(true)->find();
        dump($data);
    }
}