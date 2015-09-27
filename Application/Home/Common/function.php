<?php

/*验证是否登录*/
function CheckLogin(){
    $nickname = I('session.nickname');
    $user_en_id = I('session.user_en_id');
	if(!$nickname||empty($nickname)||!$user_en_id||empty($user_en_id)){
        header("Location: ".U('Public/login'));
    }
}

/*验证验证码的正确性*/
function check_verify($code, $id = ''){
    $Verify = new \Think\Verify();
    return $Verify->check($code, $id);
}
/*判断是否常规字符串,数字加字母和下划线*/
function is_common_string($string){
	if (preg_match('/^[\w]+$/', $string)) {  
	    return true;
	} else {  
	    return false;
	}  
}
/*判断邮箱是否符合要求*/
function is_email_string($string){
	if (preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/', $string)) {  
	    return true;
	} else {  
	    return false;
	}  
}
/*密码加密*/
function password_encode($string){
	$re = md5('adsasvzx?vzqfsaf1');
	return md5($string.$re);
}

/*json返回*/
function json_return($state, $content ,$data = ''){
	$info['state'] = $state;
	$info['message'] = $content;
	$info['data'] = $data;
	echo json_encode($info);
	die();
}

/*日志上传后的名字*/
function get_talks_name(){
	return md5(rand(0,1000)*rand(0,1000)*rand(0,1000));
}

/*日志上传后的子目录名字*/
function get_talks_id(){
	return session('user_en_id');
}

/*发送消息*/
function send_message($myenid, $itenid, $content, $type){
	$message = D('message');
	$data['sender_en_id'] = $myenid;
	$data['receiver_en_id'] = $itenid;
	$data['type'] = $type;
	$data['sent_time'] = time();
	$data['content'] = $content;
	return $message->add($data);
}

/*发送加好友请求*/
function send_friendquery($myenid, $itenid,$group_id){
	$users_contacts_entail = D('users_contacts_entail');
	if($users_contacts_entail->where("user_en_id='%s' and friend_en_id='%s' and (state=0 or state=1)",array($myenid, $itenid))->count()){
		return false;
	}
	$data['user_en_id'] = $myenid;
	$data['friend_en_id'] = $itenid;
	$data['apply_addtime'] = time();
	$data['group_id'] = $group_id;
	return $users_contacts_entail->add($data);
}

/*添加好友(同意)*/
function add_friend_agree($myenid, $itenid, $group_id){
	$users_contacts_entail = D('users_contacts_entail');//好友表
	if($users_contacts_entail->where("user_en_id='%s' and friend_en_id='%s' and state=1",array($itenid, $myenid))->count()){
		return false;
	}
	$users_contacts_entail->where("user_en_id='%s' and friend_en_id='%s' and state=0",array($itenid, $myenid))->save(array('state'=>1));
	$data['user_en_id'] = $myenid;
	$data['friend_en_id'] = $itenid;
	$data['state'] = 1;
	$data['apply_addtime'] = time();
	$data['group_id'] =  $group_id;
	return $users_contacts_entail->add($data);
}

/*判断itenid是否请求好友列表中*/
function is_friendrequest($myenid, $itenid){
	$friendrequest = D('friendrequest');
	return $friendrequest->where("sender_en_id = '%s' and receiver_en_id = '%s'",array($itenid, $myenid))->count();
}

/*移至好友到分组*/
function friend_move_group($fenid,$gid){
	$users_contacts_entail = D('users_contacts_entail');//好友表
	$info['group_id'] = $gid;
	$re = $users_contacts_entail->where("friend_en_id = '%s'",array($fenid))->save($info);
}


/*模板函数*/
/*根据用户表id得到用户名*/
function getNicknameById($id){
	$User = new \Home\Model\UserModel();
	$my = $User->where("user_id = %d",array($id))->find();
	return $my['nickname'];
}

/*根据用户表加密id得到用户名*/
function getNicknameByEnId($enid){
	$User = new \Home\Model\UserModel();
	$my = $User->where("user_en_id = '%s'",array($enid))->find();
	return $my['nickname'];
}