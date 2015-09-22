<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录页</title>
	<script type="text/javascript" src="/Public/Js/jquery.min.js"></script>
</head>
<body>
	<div>
		用户或邮箱：<input id="name" name="name" type="text" />（只能数字字母下划线）<br/><br/>
		密码：<input id="password" name="password" type="text" />（长度6-20）<br/><br/>
		验证码：<input id="checkCode" name="checkCode" type="text" /><img id="codeimg" src="<?php echo U('Common/checkCode',array('type'=>2));?>" onclick=this.src="<?php echo U('Common/checkCode',array('type'=>2));?>" /><br/><br/>
		<input type="button" onclick="dologin()" value="登录"/>
		<a href="<?php echo U('Public/register');?>"/>注册</a>
	</div>

	<script type="text/javascript">
		function dologin(){
			$("#codeimg").attr("src", "<?php echo U('Common/checkCode',array('type'=>2));?>");
			var name = $("#name").val();
			var password = $("#password").val();
			var checkCode = $("#checkCode").val();
	  		$.ajax({
	            url: "<?php echo U('Public/dologin');?>",
	            data: {"name": name ,"password": password ,"checkCode": checkCode},
	            type: 'post',
	            dataType: 'text',
	            success:function(msg){
	            	msg = eval("("+msg+")");
	            	if(msg['state'] == 200){
	            		window.location.href = "<?php echo U('Index/index');?>";
	            	}else{
	            		alert(msg['content']);
	            	}
	            }
	        })		
		}
	</script>
</body>
</html>