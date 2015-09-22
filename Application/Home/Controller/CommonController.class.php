<?php
/*
* 普通类
*/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {

	/*
    * 验证码
    * MODULE_NAME
    */
    public function checkCode(){
        $type = I('get.type');  //验证码类型,1注册页,2登录页
        $config =   array(
            "fontSize"  =>  20,
            "expire"    =>  3600,
            "length"    => 4,
            "useCurve"  => false,
        );
    	$Verify = new \Think\Verify($config);
        $Verify->entry($type);
    }
}