<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册页</title>
</head>
<body>
	<form action="<?php echo U('Public/register');?>" method="post">
		用户：<input name="name" type="text" />（只能数字字母下划线）<br/><br/>
		密码：<input name="password" type="text" />（长度6-20）<br/><br/>
		再次输入密码：<input name="repassword" type="text" /><br/><br/>
		邮箱：<input name="email" type="text" /><br/><br/>
		验证码：<input name="checkCode" type="text" /><img src="<?php echo U('Common/checkCode',array('type'=>1));?>" onclick=this.src="<?php echo U('Common/checkCode',array('type'=>1));?>" /><br/><br/>
		<input type="submit" value="注册"/>
		<a href="<?php echo U('Public/login');?>"/>登录</a>
	</form>
</body>
</html>