<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<style type="text/css">
		*{margin: 0px;padding: 0px;}
		.peoplebox{height: 50px;line-height: 50px;}
	</style>
</head>
<body>
	<link href="/chat/Public/Css/Public/header.css" rel="stylesheet" type="text/css" />
<header>
	<div class="right">
		<a href="<?php echo U('User/personal');?>"><?php echo session('nickname'); ?></a>
		<a href="<?php echo U('Public/userexit');?>">退出</a>
		<a href="<?php echo U();?>">message:<?php $message = D('message'); $where['receiver_id'] = session('user_id');$count = $message->where($where)->count();echo $count; ?></a>
	</div>
</header>
	<div class="peoplebox">
		姓名:<?php echo ($data["nickname"]); ?>  <a href="<?php echo U('User/addFriend');?>">加好友</a> <a href="<?php echo U('User/sendMessage');?>">发消息</a>
	</div>
</body>
</html>