<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<style type="text/css">*{margin: 0px;padding: 0px;}</style>
</head>
<body>
	<link href="/Public/Css/Public/header.css" rel="stylesheet" type="text/css" />
<header>
	<div class="right">
		<a href="<?php echo U('User/personal');?>"><?php echo session('nickname'); ?></a>
		<a href="<?php echo U('Public/userexit');?>">退出</a>
	</div>
</header>
</body>
</html>