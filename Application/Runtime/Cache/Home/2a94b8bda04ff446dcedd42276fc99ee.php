<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<script type="text/javascript" src="/chat/Public/Js/jquery.min.js"></script>
	<style type="text/css">
		*{margin: 0px;padding: 0px;}
		.group{height: 30px;line-height: 30px;}
	</style>
</head>
<body>
	<link href="/chat/Public/Css/Public/header.css" rel="stylesheet" type="text/css" />
<header>
	<div class="right">
		<a href="<?php echo U('User/personal');?>"><?php echo session('nickname'); ?></a>
		<a href="<?php echo U('Public/userexit');?>">退出</a>
		<a href="<?php echo U('Message/index');?>">message:<span id="message_count"></span></a>
	</div>
	<a href="<?php echo U('User/myfriend');?>">我的朋友</a>
	<script type="text/javascript">
  		$.ajax({
            url: "<?php echo U('Message/message_weidu_count');?>",
            type: 'get',
            dataType: 'text',
            success:function(msg){
            	msg = eval("("+msg+")");
            	if(msg['state'] == 200){
            		$("#message_count").text(msg['data']);
            	}else{
            		alert(msg['content']);
            	}
            }
        })	
	</script>
</header>
	<?php if(is_array($data)): foreach($data as $key=>$vo): ?><div class="group">
			姓名:<?php echo ($vo["nickname"]); ?> 
			<a href="<?php echo U('User/addFriend',array('en_id'=>$vo[user_en_id]));?>">加好友</a> 
			<a href="<?php echo U('Message/sendMessage',array('en_id'=>$vo[user_en_id]));?>">发送信息</a>
			<a href="<?php echo U('Message/friendMessage',array('en_id'=>$vo[user_en_id]));?>">查看记录</a>
		</div><?php endforeach; endif; ?>
</body>
</html>