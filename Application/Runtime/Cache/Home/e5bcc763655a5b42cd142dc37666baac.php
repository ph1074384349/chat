<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>
	<script type="text/javascript" src="/chat/Public/Js/jquery.min.js"></script>
	<style type="text/css">
		li{list-style: none;}
	</style>
</head>
<body>
	<a href="<?php echo U('User/info');?>">资料</a>
	<link rel="stylesheet" type="text/css" href="/chat/Public/biaoqing/sendTalks.css">
<script type="text/javascript" src="/chat/Public/Js/jquery.min.js"></script>
<div class="editordaily">
    <form action="<?php echo U('User/doTalksSubmit');?>" method="post" enctype='multipart/form-data'>
        <div id="main">
             <div class="comment">
                <div class="com_form">
                    <textarea class="input" id="saytext" name="content"></textarea>
                    <p>
                        <input type="submit" class="sub_btn" value="提交">
                        <span class="emotion">表情</span>
                        <span class="photo">图片</span>
                    </p>
                </div>
             </div>
             <div class="imgbox">
                <div class="addphoto">
                    <span></span>
                    <input class="myfile" name="logimg[]" type="file"/>
                </div>
             </div> 
        </div>
    </form>    
    <script type="text/javascript" src="/chat/Public/biaoqing/jquery.qqFace.js"></script>
    <script type="text/javascript" src="/chat/Public/biaoqing/sendTalks.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.emotion').qqFace({
                id : 'facebox', //表情盒子的ID
                assign:'saytext', //给那个控件赋值
                path:'/chat/Public/biaoqing/face/'    //表情存放的路径
            });
            $(".sub_btn").click(function(){
                var str = $("#saytext").val();
                $("#show").html(replace_em(str));
            });
        });
    </script>
</div>
	<div class="showDaily">
		<div id="dailyBox">
			<ul>
				<?php if(is_array($talks)): foreach($talks as $key=>$vo): ?><li>
						<span><?php echo ($vo["content"]); ?></span>
						<div class="dailyImages">
							<?php $img_url = unserialize($vo[img_url]); foreach($img_url as $value){ $url = "/chat".$value; echo "<img src=$url>"; } ?>
						</div>
					</li><?php endforeach; endif; ?>						
			</ul>
		</div>
		<script type="text/javascript">
		    $("#dailyBox li span").each(function(){
		    	var content = $(this).text();
			    var reg = /\[em_([\d]+)\]/g;
			    content = content.replace(reg,'<img src="//chat/Public/biaoqing/face/$1.gif"/>');
			    $(this).html(content);		    	
		    });

    	</script>
	</div>
</body>
</html>