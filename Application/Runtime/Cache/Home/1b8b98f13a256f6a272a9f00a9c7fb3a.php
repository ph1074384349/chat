<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的朋友</title>
	<script type="text/javascript" src="/chat/Public/Js/jquery.min.js"></script>
</head>
<body>
	<div><input class="contactsName" type="text" /><a href="#" onclick="add_contacts(this)">添加分组</a></div>
	<?php if(is_array($contacts)): foreach($contacts as $key=>$vo): ?><div>
			<h3><?php echo ($vo["name"]); ?> <input class="contactsName" type="text" /><a href="#" onclick="edit_contacts(this)">修改名字</a><input class="contactsOname" type="hidden" value="<?php echo ($vo["name"]); ?>"/></h3>
		<ul>
			<?php if(is_array($vo[friend])): foreach($vo[friend] as $key=>$it): ?><li><?php echo (getNicknameByEnId($it["friend_en_id"])); ?> <a href="">删除</a> <a href="">加入黑名单</a> <a href="<?php echo U('User/moveContacts',array('fenid'=>$it[friend_en_id]));?>">移至</a></li><?php endforeach; endif; ?>			
		</ul>
		</div><?php endforeach; endif; ?>
	<script type="text/javascript">
	function add_contacts(obj){
		var contactsName = $(obj).parent().find(".contactsName").val();
		if(!$.trim(contactsName)) {
			alert('分组名不明为空');return;
		}
		$.ajax({
			type: "POST",
			url: "<?php echo U('User/addContacts');?>",
			data: {contactsName: contactsName},
			dataType: "json",
			success: function(data){
				alert(data['message']);
			}
		});
	}
	function edit_contacts(obj){
		var contactsName = $(obj).parent().find(".contactsName").val();
		var contactsOname = $(obj).parent().find(".contactsOname").val();
		if(!$.trim(contactsName)) {
			alert('分组名不明为空');return;
		}
		$.ajax({
			type: "POST",
			url: "<?php echo U('User/editContacts');?>",
			data: {contactsName: contactsName,contactsOname: contactsOname},
			dataType: "json",
			success: function(data){
				alert(data['message']);
			}
		});
	}
	</script>
</body>
</html>