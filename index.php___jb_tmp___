<?php
/**
 * Created by PhpStorm.
 * User: 师鹏程
 * Date: 2018/8/30
 * Time: 9:23
 */
//入口文件
//var_dump($_SERVER);die;
//图片在本地网址显示
//http://localhost/php_code/MVC/Public/phpMyAdmin3_files/logo_right.png

//图片 url中地址如何展示 css、js文件夹名加url路径（很长的那个图片）
//http://localhost/phpmyadmin/themes/pmahomme/img/sprites.png?v=4.6.4
//箭头图片
//http://localhost/phpmyadmin/themes/pmahomme/img/arrow_ltr.png

//index.php/a/b

//防止页面乱码
header("content-type:text/html;charset=utf-8");
//echo '你';
//判断是否输入控制器A和方法B 若没有输入 跳转到welcome页面
if(!isset($_SERVER['PATH_INFO'])){
    //没有$_SERVER['PATH_INFO']时，给它赋一个值 继续执行下面的跳转代码
    $_SERVER['PATH_INFO']='/A/C';

}
$path_info=$_SERVER['PATH_INFO'];//取出/a/b
//去除左边的'/'
$path_info=ltrim($path_info,'/');

//echo $path_info;
//将去除'/'的数据转为数组
$function=explode('/',$path_info);

//将控制器名称和方法名称首字母大写
$function[0]=ucfirst($function[0]);
$function[1]=ucfirst($function[1]);

//db链接数据库
include 'Vendor/db.class.php';
include  'Common/db.config.php';
//启动session
session_start();
//定义全局变量 实例化一个新的对象
$GLOBALS['db']=new db($config['db']);
$GLOBALS['db']->query('set names utf8');//设置字符集编码格式

$project=$_SERVER['SCRIPT_NAME'];
$project=ltrim($project,'/');
$project=explode('/',$project);
//var_dump($project);die;


$host=$_SERVER['HTTP_HOST'];

//定义常量  Public/文件夹下
define("__PUBLIC__",'http://'.$host.'/'.$project[0].'/'.$project[1].'/Public/');
//echo __PUBLIC__;die;
//var_dump($function);
//包含（执行）controller 中的文件 拼接路径 Controller/A.class.php
//控制器中的文件后缀名是.class.php
//View 中的文件后缀名是.html

include 'Controller/'.$function[0].'.class.php';
//后面的array()数组中是$function[1]方法中的参数
// $function[0]师控制器名称
//@避免显示异常错误 如html页面乱码
$a=@call_user_func_array(array($function[0],$function[1]),array());



