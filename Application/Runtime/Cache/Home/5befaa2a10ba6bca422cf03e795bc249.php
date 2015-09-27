<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>记录</title>
</head>
<body>
	<h1><?php echo (getNicknameByEnId($itenid)); ?></h1>
	<h2>发送</h2>
	<ul>
		<?php if(is_array($data_send)): foreach($data_send as $key=>$vo): ?><li><?php echo ($vo[content]); ?></li><?php endforeach; endif; ?>		
	</ul>
	<h2>接受</h2>
	<ul>
		<?php if(is_array($data_receive)): foreach($data_receive as $key=>$vo): ?><li><?php echo ($vo[content]); ?></li><?php endforeach; endif; ?>		
	</ul>
</body>
</html>