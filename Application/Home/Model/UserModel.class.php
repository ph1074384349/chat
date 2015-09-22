<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{
	protected $tableName = 'users_login'; // 表名 
	protected $_validate = array();
    protected $_auto = array ( 
        array('reg_time','time',1,'function'), //对reg_time字段在新增的时候写入当前时间戳
    );
    protected $insertFields = array('user_name','user_en_id','password','email','reg_time');    
    // protected $updateFields = array('nickname','email');
    protected $_link = array(        
	    'profile'=>array(            
	    	'mapping_type'      => self::HAS_ONE,            
	    	'class_name'        => 'Profile',
		    'foreign_key'       => 'uid',
	    ),        
    );
}
