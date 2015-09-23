//查看结果
function replace_em(str){
    str = str.replace(/\</g,'&lt;');
    str = str.replace(/\>/g,'&gt;');
    str = str.replace(/\n/g,'<br/>');
    str = str.replace(/\[em_([0-9]*)\]/g,'<img src="face/$1.gif" border="0" />');
    return str;
}

$(".photo").click(function(){
    $(".imgbox").toggle();
});
$('.myfile').live('change',function(event){
    var addphoto = $(this).prev();
    var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) return;
    if (/^image/.test( files[0].type)){
        var reader = new FileReader();
        reader.readAsDataURL(files[0]);
        reader.onloadend = function(){  
            var img = document.createElement("img");
            img.src = this.result;
            $(img).appendTo(addphoto);
            createPhoto();
        }
    }
});
function createPhoto(){
    $('<div class="addphoto"><span></span><input class="myfile" name="logimg[]" type="file"/></div>').appendTo($(".imgbox"));
}
