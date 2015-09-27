<?php
/*
* 消息类
*/
namespace Home\Controller;
use Think\Controller;
class MessageController extends Controller {

    /*初始化*/
    function _initialize(){
        CheckLogin(); //检查用户是否登录
        $this->Message = D('message');
        $this->myenid = session('user_en_id'); //自己用户表的id 
    }


	/*消息列表*/
	function index(){
		$myenid = session('user_en_id');
		$users_contacts_entail = D('users_contacts_entail');
		$data = $this->Message->where("receiver_en_id = '%s'",array($myenid))->select();
		$friendmessage = $users_contacts_entail->where("friend_en_id = '%s' and state = 0",array($myenid))->select();
		$this->data = $data;
		$this->friendmessage = $friendmessage;
		$this->display();
	}

	/*发送消息*/
	function sendMessage(){
		$itenid = I('get.en_id');
		$this->itenid = $itenid;
		$this->display();
	}

	/*处理发送消息*/
	function dosendMessage(){
		$myenid = session('user_en_id');
		$itenid = I('post.en_id');
		$this->itenid = $itenid;
        send_message($myenid, $itenid, I('post.content'), 0);//发送消息
	}

	/*查看消息*/
	function friendMessage(){
		$myenid = session('user_en_id');
		$itenid = I('get.en_id');
		$data_send = $this->Message->where("sender_en_id='%s' and receiver_en_id='%s'",array($myenid, $itenid))->select();//发送
		$data_receive = $this->Message->where("sender_en_id='%s' and receiver_en_id='%s'",array($itenid, $myenid))->select();//接受
		$this->data_send = $data_send;
		$this->data_receive = $data_receive;
		$this->itenid = $itenid;
		$this->display();
	}

	/*未读消息*/
	function message_weidu_count(){
		$friendrequest = D('friendrequest');
		$count = $this->Message->where("receiver_en_id = '%s' and readed = 0 and deleted = 0",array($this->myenid))->count();
		$num = $friendrequest->where("receiver_en_id = '%s'",array($this->myenid))->count();
		$sum = $count + $num;
		json_return(200,'success',$sum);
	}
}