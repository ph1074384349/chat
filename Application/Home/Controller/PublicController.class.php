<?php
/*
* 公用类
*/
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {

   /*初始化*/
    function _initialize(){
        $this->User = new \Home\Model\UserModel();
    }

	/*注册*/
    public function register(){
    	if(IS_POST){ //处理注册
    		extract($_POST);
            $password = trim($password);
            $repassword = trim($repassword);
            $email = trim($email);
            $checkCode = trim($checkCode);
    		if($password != $repassword){	//密码不相等
    			$this->error("输入的两次密码不相等");
    		}
    		if(strlen($password) < 6 || strlen($password) > 20){
    			$this->error("输入的密码长度不符合要求");
    		}
    		if(!is_common_string($name)){	//判断用户名是否是常规字符串
    			$this->error("输入的用户名中有非法字符");
    		}
    		if(!is_email_string($email)){ //判断邮箱是否符合要求
                $this->error("邮箱格式不正确");
            }
    		if(!check_verify($checkCode, 1)){	//验证验证码
    			$this->error("验证码错误");
    		}
    		if($this->User->where("user_name = '%s'",array($name))->count() > 0){
    			$this->error("已经存在用户");
    		}
    		if($this->User->where("email = '%s'",array($email))->count() > 0){
    			$this->error("已经存在邮箱");
    		}
			if (!$this->User->create()){ // 创建数据对象
			     // 如果创建失败 表示验证没有通过 输出错误提示信息
			    exit($this->User->getError());
			}else{
	    		if(!$this->User->autoCheckToken($_POST)){	//验证表单重复提交
	    			header("Location: ".U('Public/register'));
	    		}
	    		$this->User->user_name = $name;
                $this->User->nickname = $name;
				$this->User->password = password_encode($password);
				$this->User->email = $email;
				$this->User->profile = array(
					'affectivestatus' => 0,
				);
				$this->User->user_en_id = md5($name.$password.time());
			    $this->User->relation("profile")->add();
                header("Location: ".U('Index/index'));
			}
    	}else{ //注册页
    		$this->display();
    	}
    }

    /*登录页*/
    public function login(){
    	$this->display();
    }

    /*处理登录(异步)*/
    function dologin(){
        extract($_POST);
        $name = trim($name);
        $password = trim($password);
        if(strlen($password) < 6 || strlen($password) > 20){
            json_return(400,'密码长度不符合要求');
        }
        // if(!check_verify($checkCode, 2)){    //验证验证码
        //     json_return(400,'验证码错误');
        // }
        if (preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/', $name)){  //邮箱登录
            $pass = $this->User->field('password,user_en_id,nickname')->where("email = '%s'",array($name))->find(); //正确的密码
            if($pass['password'] == password_encode($password)){
                session('nickname',$pass['nickname']);
                session('user_en_id', $pass['user_en_id']);
                json_return(200, '正确');
            }else{
                json_return(400, '用户名或密码错误');
            }
        }else{  //用户名登录
            $pass = $this->User->field('password,user_en_id,nickname')->where("user_name = '%s'",array($name))->find(); //正确的密码
            if($pass['password'] == password_encode($password)){
                session('nickname', $pass['nickname']);
                session('user_en_id', $pass['user_en_id']);
                json_return(200, '正确');
            }else{
                json_return(400, '用户名或密码错误');
            }
        }
    }

    /*退出*/
    function userExit(){
    	session('[destroy]');
    }
}