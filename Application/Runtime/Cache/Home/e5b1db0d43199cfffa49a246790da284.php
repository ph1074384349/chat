<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑资料</title>
	<script type="text/javascript" src="/chat/Public/Js/jquery.min.js"></script>
	<style type="text/css">
		.group{height: 30px;}
	</style>
</head>
<body>
<!-- 	<div class="group">
		生日 :<input type="text"/>
	</div>
	<div class="group">
		性别 :<input type="text"/>
	</div>
	<div class="group">
		性别 :<input type="text"/>
<<<<<<< HEAD
	</div>
=======
	</div> -->
>>>>>>> origin/master
	<div id="selectcitysbox">
	<select id="provinceValue" class="provinceValue" name="provinceValue" onchange="getcitys(this)">
		<option>必填</option>
	</select>
	<select id="cityValue" class="cityValue" name="cityValue" onchange="getarea(this)">
		<option>必填</option>
	</select>
	<select id="areaValue" class="areaValue" name="areaValue">
		<option>可选填</option>
	</select>
</div>

<script type="text/javascript">
	getprovince();
	function getprovince(){
		$.ajax({
			type: "GET",
			url: "<?php echo U('ApigetCitys/province');?>",
			dataType: "json",
			success: function(data){
				var data = data['data'];
				$("#provinceValue").empty();
				$(data).each(function(key, value){
					$("<option value="+value['code']+">"+value['name']+"</option>").appendTo($("#provinceValue"));
				});
			}
		});
	}

	function getcitys(obj){
		$.ajax({
			type: "GET",
			url: "<?php echo U('ApigetCitys/city');?>",
			data: {province_code: $(obj).val()},
			dataType: "json",
			success: function(data){
				$("#cityValue").empty();
				var data = data['data'];
				$(data).each(function(key, value){
					$("<option value="+value['code']+">"+value['name']+"</option>").appendTo($("#cityValue"));
				});
			}
		});
	}

	function getarea(obj){
		$.ajax({
			type: "GET",
			url: "<?php echo U('ApigetCitys/area');?>",
			data: {city_code: $(obj).val()},
			dataType: "json",
			success: function(data){
				$("#areaValue").empty();
				$("<option value='0'>可选填</option>").appendTo($("#areaValue"));
				var data = data['data'];
				$(data).each(function(key, value){
					$("<option value="+value['code']+">"+value['name']+"</option>").appendTo($("#areaValue"));
				});
			}
		});
	}
</script>
</body>
</html>