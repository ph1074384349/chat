<?php
/*
* 用户类
*/
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

    /*初始化*/
    function _initialize(){
        CheckLogin(); //检查用户是否登录
        $this->User = new \Home\Model\UserModel();
        $this->users_talk = D('users_talk');
    }

    /*个人中心*/
    public function personal(){
        //个人日志
        $talks = $this->users_talk->where("user_id = %d",array(session('user_id')))->select();
        $this->talks = $talks;
        $this->display();
    }

    /*编辑个人资料*/
    public function personaledit(){
        dump("asds");
        // $where['sp_users_login.user_en_id'] = session('user_en_id');
        // $data = $this->User->where($where)->relation(true)->find();
        // //dump($data);
        // $this->display();
    }

    /*处理日志提交*/
    function doTalksSubmit(){
        $content = I('post.content');
        $content = strip_tags($content);
        $content = addslashes($content);
        $data['img_url'] = serialize($this->upload());
        $data['content'] = $content;
        $data['talk_addtime'] = time();
        $data['talk_en_id'] = md5(session('user_en_id')*time());
        $data['user_id'] = session('user_id');
        $this->users_talk->add($data);
    }



    /*图片上传（日志）*/
    public function upload(){
        $limitSize = 1024*1024*8; // 设置附件上传大小于8M
        $image_num = count($_FILES['logimg']['name']) - 1;//图片张数
        $this->imagesSize($image_num, $limitSize);
        if($image_num == 0) return;
        if($image_num > 6) $this->error("上传的图片大于6张!"); 
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     $limitSize;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','JPG');// 设置附件上传类型
        $upload->rootPath  =     './Images/Users/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->saveName  =     'get_talks_name'; //上传后的名字
        $upload->autoSub   =      true;
        $upload->subName   =      'get_talks_id';
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $image = new \Think\Image(); 
            $thumbImages = array();
            foreach ($info as $value) {
                $imagePath = "./Images/Users/".$value['savepath'].$value['savename'];
                $image->open($imagePath);
                $thumbPath = "./Images/Users/".$value['savepath']."thumb_".$value['savename'];
                $image->thumb(200, 200)->save($thumbPath);
                array_push($thumbImages,"/Images/Users/".$value['savepath'].$value['savename']);
            }
            return $thumbImages;
        }
    }


    /*限制图片上传大小（日志）*/
    public function imagesSize($image_num, $limitSize){
        for ($i=0; $i <= $image_num; $i++) { 
            if($_FILES['logimg']['size'][$i] > $limitSize){
                $this->error("上传文件大小有大于5M的文件！");
            }
        }
    }
}