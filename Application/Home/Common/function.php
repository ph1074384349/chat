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
	$info['content'] = $content;
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