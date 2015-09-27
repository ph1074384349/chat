<?php
/*
* 用户类
*/
namespace Home\Controller;
use Think\Controller;
class ApigetCitysController extends Controller {
    //省份
    function province(){
        $citys = D('citys');
        $where['level'] = 1;
        $data = $citys->field('name,code')->where($where)->select();
        json_return(200, '成功',$data);
    }

    //城市
    function city(){
        $province_code = I('get.province_code');
        is_numeric($province_code)&&strlen($province_code)==2 ? $province_code : json_return(400, '省份code不符合要求');
        $citys = D('citys');
        $where['parentId'] = $province_code;
        $data = $citys->field('name,code')->where($where)->select();
        empty($data) ? json_return(400, '为空'): json_return(200, '成功',$data);
    }

    //区域
    function area(){
        $city_code = I('get.city_code');
        is_numeric($city_code) ? $city_code : json_return(400, '城市code不符合要求');
        $citys = D('citys');
        $where['parentId'] = $city_code;
        $data = $citys->field('name,code')->where($where)->select();
        empty($data) ? json_return(400, '为空'): json_return(200, '成功',$data);
    }    
}

