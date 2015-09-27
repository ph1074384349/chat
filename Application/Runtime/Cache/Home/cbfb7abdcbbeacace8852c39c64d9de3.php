<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>移至</title>
</head>
<body>
	<ul>
		<?php if(is_array($data)): foreach($data as $key=>$vo): ?><li><a href="<?php echo U('User/domoveContacts',array('gid'=>$vo[group_id],'fenid'=>$friend_en_id ));?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>		
	</ul>

</body>
</html>