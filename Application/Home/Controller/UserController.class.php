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
        $this->friendrequest = D('friendrequest');
        $this->myenid = session('user_en_id'); //自己用户表的id 
    }

    /*个人中心*/
    public function personal(){
        //个人日志
        $talks = $this->users_talk->where("user_id = %d",array(session('user_id')))->select();
        $data = $this->User->where("user_id = %d",array(session('user_id')))->relation(true)->find();
        $this->talks = $talks;
        $this->data = $data;
        $this->display();
    }

    /*编辑个人资料*/
    public function personaledit(){
        $where['sp_users_login.user_en_id'] = session('user_en_id');
        $data = $this->User->where($where)->relation(true)->find();
        //dump($data);
        $this->display();
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

    /*使用者头像图片编辑*/
    public function headimgurlchange(){
        $limitSize = 1024*1024*8; // 设置附件上传大小于8M
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     $limitSize;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','JPG');// 设置附件上传类型
        $upload->rootPath  =     './Images/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->saveName  =     'get_talks_id'; //上传后的名字
        $upload->autoSub   =      true;
        $upload->subName   =      'Headimgurl';
        $upload->replace = true;
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $image = new \Think\Image(); 
            $thumbImages = array();
            $imagePath = "./Images/Headimgurl/".$info['imgupload']['savename'];
            $image->open($imagePath);
            $thumbPath = "./Images/Headimgurl/"."thumb_".$info['imgupload']['savename'];
            $image->thumb(200, 200)->save($thumbPath);
            $this->success('修改成功');
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

    /*加好友*/  
    public function addFriend(){
<<<<<<< HEAD
        $itenid = I('get.en_id');//要加的好友的加密的id
        $users_contacts_group = D('users_contacts_group');
        $group = $users_contacts_group->where("user_en_id='%s'",array($itenid))->find();
        if(!send_friendquery($this->myenid,$itenid,$group['group_id'])){
            $this->error('已发送请求,请耐心等待！');
        }
        $this->success('发送好友请求成功！');
    }

    /*同意添加好友*/
    function friend_agree(){
        //判断有无此好友请求
        $itenid = I('get.id');
        $users_contacts_group = D('users_contacts_group');
        $group = $users_contacts_group->where("user_en_id='%s'",array($this->myenid))->find();
        if(!add_friend_agree($this->myenid, $itenid,$group['group_id'])){
            $this->error('已经是好友了！');
        }
    }
    /*不同意添加好友*/
    function friend_disagree(){
        $itenid = I('get.id');
        if(!is_friendrequest($this->myenid, $itenid)){
            $this->error('没有此好友其请求！');
        }
    }
    /*忽略添加好友*/
    function friend_ignore(){
        $itenid = I('get.id');
        if(!is_friendrequest($this->myenid, $itenid)){
            $this->error('没有此好友其请求！');
        }
    }

    /*我的朋友*/
    function myfriend(){
        //$contacts_group = array();
        //获取分组
        $users_contacts_group = D('users_contacts_group');
        $users_contacts_entail = D('users_contacts_entail');
        $group = $users_contacts_group->where("user_en_id='%s'",array($this->myenid))->select();
        //获取各组联系人
        foreach ($group as $value) {
            $vo['name'] = $value['name'];
            $vo['friend'] = $users_contacts_entail->where("group_id=%d",array($value['group_id']))->select();
            $contacts_group[] = $vo;
        }
        $this->contacts = $contacts_group;
        $this->display();
    }

    /*添加联系人分组*/
    function addContacts(){
        $contactsName = I('post.contactsName');//添加分组的名字
        $users_contacts_group = D('users_contacts_group');
        if($users_contacts_group->where("user_en_id = '%s' and name = '%s'",array($this->myenid,$contactsName))->count()){
            json_return(400,'已存在分组(添加)');
        }
        $info['user_en_id'] = $this->myenid;
        $info['name'] = $contactsName;
        $info['group_time'] = time();
        $result = $users_contacts_group->add($info);
        json_return(200,'success',$result);
    }
    /*修改联系人分组*/
    function editContacts(){
        $contactsOname = I('post.contactsOname');//分组的原名字
        $contactsName = I('post.contactsName');//分组的名字
        $users_contacts_group = D('users_contacts_group');
        if($users_contacts_group->where("user_en_id = '%s' and name = '%s'",array($this->myenid,$contactsName))->count()){
            json_return(400,'已存在分组(修改)');
        }
        $info['name'] = $contactsName;
        $info['group_edit_time'] = time();
        $result = $users_contacts_group->where("user_en_id = '%s' and name = '%s'",array($this->myenid,$contactsOname))->save($info);
        json_return(200,'success',$result);
    }
    /*删除联系人分组*/
    function deleteContacts(){
        
    }
    /*移至联系*/
    function moveContacts(){
        $friend_en_id = I('get.fenid');
        session('move_friend_en_id', $friend_en_id );//保存要移动的好友加密的id
        $users_contacts_group = D('users_contacts_group');
        $data = $users_contacts_group->where("user_en_id = '%s'",array($this->myenid))->select();
        $this->data = $data;
        $this->friend_en_id = $friend_en_id;
        $this->display();
    }
    /*处理移至联系*/
    function domoveContacts(){
        //没有经过有无此组验证
        $group_id = I('get.gid');//要移至的组id
        $fenid = I('get.fenid');//要移动的好友
        friend_move_group($fenid, $group_id);
    }
=======

    }

    /*向好友发送消息*/
    public function sendMessage(){
        
    }
>>>>>>> origin/master
}