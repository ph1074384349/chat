<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>发送消息</title>
</head>
<body>
	<form action="<?php echo U('Message/dosendMessage');?>" method="post">
		<input type="text" name="content"><br/><br/>
		<input type="submit" value="提交">
		<input type="hidden" name="en_id" value="<?php echo ($itenid); ?>">
	</form>
</body>
</html>