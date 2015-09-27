<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>信息</title>
	<style type="text/css">
		.b1{background-color: #dfdfdf;height: 20px;}
		.b2{height: 20px;}
	</style>
</head>
<body>
	<h2>接受</h2>
	<?php if(is_array($friendmessage)): foreach($friendmessage as $key=>$vo): ?><div>
			<?php echo (getNicknameByEnId($vo["user_en_id"])); ?>
			<a href="<?php echo U('User/friend_agree',array('id'=>$vo[user_en_id]));?>">同意</a>
			<a href="<?php echo U('User/friend_disagree',array('id'=>$vo[user_en_id]));?>">不同意</a>
			<a href="<?php echo U('User/friend_ignore',array('id'=>$vo[user_en_id]));?>">忽略</a>
		</div><?php endforeach; endif; ?>
</body>
</html>