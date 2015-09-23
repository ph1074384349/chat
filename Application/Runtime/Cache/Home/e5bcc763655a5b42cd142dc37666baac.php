<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>
	<script type="text/javascript" src="/chat/Public/Js/jquery.min.js"></script>
	<style type="text/css">
		li{list-style: none;}
		#showDaily{width: 600px;float: left;}
		#showDaily ul{padding: 0px;}
		#showDaily li{border: 1px solid #dfdfdf;border-top: 0px;padding: 5px 5px;}
		#showDaily li span{width: 94%;display: block;text-align: left;line-height: 20px;margin-bottom: 10px;padding: 0 3%;}
		#showDaily li span .eimg{width: 20px;height: 20px;vertical-align:bottom;}
		#showDaily li .userbox{padding: 0 20px;text-align: left;}
		#showDaily li .time{bottom: 5px;right: 10px;width: 100%;text-align: right;}
		#showDaily li .conbox{text-align: right;}
		.dailyImages img{height: 90px;width: 90px;margin-right: 7px;}

		#personalbox{background-color: #dfdfdf;height: 600px;width: 230px;float: left;margin-right: 120px;}
		#personalbox .img{width: 100%;text-align: center;padding-top: 20px;position: relative;}
		#personalbox .img img{width: 120px;height: 120px;cursor: pointer;}
		#personalbox .img .hr{height: 20px;width: 200px;margin: 0 auto;border-bottom: 1px solid #999;} 
		#personalbox .img .imguploadbox{position: absolute;top:0px;left:0px;width: 100%;height: 100%;background-color: yellow;}
		#personalbox .img .imgupload{position: absolute;top:0px;left:0px;width: 100%;height: 100%;filter:alpha(opacity:0);opacity: 0;cursor: pointer;}
		#personalbox .img .imguploadbox{position: absolute;width: 0%;left: 55px;height: 1px;top: 20px;height: 120px;}
		#personalbox .img .imgupload{position: absolute;width: 0%;left: 55px;height: 1px;top: 20px;height: 120px;}
	</style>
</head>
<body>
	<a href="<?php echo U('User/info');?>">资料</a>
<!-- 	<link rel="stylesheet" type="text/css" href="/chat/Public/biaoqing/sendTalks.css">
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
</div> 发布日志-->
	<div id="personalbox">
		<div class="img">
			<img class="headimg" src="/chat/Images/Users/9d4afb83528875aef9e0380b7901d0ba/0a37f62af626ceca6b25ca60a959b6f5.jpg"/>
			<div class="hr"></div>
			<div class="imguploadbox"></div>
			<input class="imgupload" type="file"/>
		</div>
		<div><a href="<?php echo U('User/personaledit');?>">编辑</a></div>
	</div>
	<div id="showDaily">
		<ul>
			<?php if(is_array($talks)): foreach($talks as $key=>$vo): ?><li>
					<div class="userbox">id:<?php echo ($vo["user_id"]); ?></div>
					<span><?php echo ($vo["content"]); ?></span>
					<div class="dailyImages">
						<?php $img_url = unserialize($vo[img_url]); foreach($img_url as $value){ $url = "/chat".$value; echo "<img src=$url>"; } ?>
					</div>
					<div class="time"><?php echo (date("Y-m-d H:i:s",$vo['talk_addtime'])); ?></div>
					<div class="conbox">(+1)</div>
				</li><?php endforeach; endif; ?>						
		</ul>
		<!--日志框-->
		<script type="text/javascript">
			$("#personalbox .headimg").mouseover(function(){
				$(".imguploadbox").animate({'width': "120px"},300);
				$(".imgupload").animate({'width': "120px"},300);
			});
			$("#personalbox .imgupload").mouseout(function(){
				$(".imguploadbox").animate({'width': "0px"},300);
				$(".imgupload").animate({'width': "0px"},300);
			});
		</script>

		<!--日志框-->
		<script type="text/javascript">
		    $("#showDaily li span").each(function(){
		    	var content = $(this).text();
			    var reg = /\[em_([\d]+)\]/g;
			    content = content.replace(reg,'<img class="eimg" src="/chat/Public/biaoqing/face/$1.gif"/>');
			    $(this).html(content);		    	
		    });
    	</script>
	</div>
</body>
</html>