<?php
/**
 * Created by PhpStorm.
 * User: 师鹏程
 * Date: 2018/8/31
 * Time: 11:44
 */
class Phpmyadmin{
    //登录
    public function login(){
        if(!isset($_SESSION['username'])){
            include 'View/PhpMyAdmin/login.html';
        }else{
            $database=$GLOBALS['db']->query('show databases')->fetchAll();
            include 'View/PhpMyAdmin/home.html';
        }

    }
    //删除session
    public function deleteSession(){
        unset($_SESSION['username']);
        include 'View/PhpMyAdmin/login.html';
    }
    //首页
    public function homeIndex(){
        $database=$GLOBALS['db']->query('show databases')->fetchAll();

        include 'View/PhpMyAdmin/home.html';
    }
    public function loginCheck(){

        $user=$_POST['pma_username'];

        $pwd=$_POST['pma_password"'];
        $result=$GLOBALS['db']->query('select User from mysql.user where User="'.$user.'" limit 1')->fetchOne();




        if(empty($result)){
            die('此用户不存在!');
        }else{
            //查询所有的库
            $database=$GLOBALS['db']->query('show databases')->fetchAll();
            //存储session_name
            $_SESSION['username']=$user;
                //var_dump($result);die;
            include 'View/PhpMyAdmin/home.html';
        }



    }
        //查库对应的表
    public function showTables(){
        $database=$_GET['database'];
        //var_dump($database);exit;
        $GLOBALS['db']->query("use $database;");
        $result=$GLOBALS['db']->query("show tables;")->fetchAll();

        $jsonString= json_encode($result);
        //var_dump($jsonString);exit;
        $jsonString = str_replace("Tables_in_$database",'name',$jsonString);
        //echo $jsonString;
        $result=json_decode($jsonString,true);
        include 'View/PhpMyAdmin/tableList.html';
    }
    public function getFieldIndex(){
        $database=$_GET['database'];
        $table=$_GET['table'];
        include 'View/PhpMyAdmin/fieldIndex.html';
    }
    public function getFieldList(){
        $database=$_GET['database'];
        $table=$_GET['table'];
        //var_dump($table);die;
        $result=$GLOBALS['db']->query("desc $database.$table;")->fetchAll();
        //var_dump($result);die;
        include 'View/PhpMyAdmin/fieldIndexList.html';

    }

    public function getIndexList(){
        $database=$_GET['database'];
        $table=$_GET['table'];
        //var_dump($table);die;
        $result=$GLOBALS['db']->query("show index from $database.$table;")->fetchAll();
        //var_dump($result);die;
        include 'View/PhpMyAdmin/indexList.html';

    }

    //从information库中SCHEMATA表中查找所有库的信息
    public function databaseMag(){
        $database=$GLOBALS['db']->query('show databases')->fetchAll();
        $GLOBALS['db']->query("use information_schema;");
        $databaseResult=$GLOBALS['db']->query("select SCHEMA_NAME,DEFAULT_COLLATION_NAME from SCHEMATA;")->fetchAll();
        include 'View/PhpMyAdmin/database.html';
    }

    public function getTables()//点击数据库名获取对应的数据表
    {
        $database=$_GET['database'];//获取数据库
        $GLOBALS['db']->query("use $database");
        $res = $GLOBALS['db']->query("show tables")->fetchAll();//获取所有表
        $string =json_encode($res);
        $string = str_replace("Tables_in_$database",'name',$string);

        $result=json_decode($string,true);

        //var_dump($result);die;
        include 'View/PhpMyAdmin/getTables.html';

    }
    //新建数据库
    public function createDatabase(){

        $database=$_POST['new_db'];
        $GLOBALS['db']->query("create database $database;");
        //include 'View/PhpMyAdmin/database.html';
        header("Location:http://localhost/php_code/MVC/index.php/phpmyadmin/databaseMag");
//        header('http://localhost/php_code/MVC/index.php/phpmyadmin/databaseMag');


    }

    //获取右边表的详细信息
    public function tableMsg(){

        $database=$_GET['database'];//获取数据库
        $table=$_GET['table'];

        $GLOBALS['db']->query("use $database");
        //$GLOBALS['db']->query('set names utf8');
        $res = $GLOBALS['db']->query("select * from $table;")->fetchAll();//获取所有表
        $string =json_encode($res);


        $string = str_replace("Tables_in_$database",'name',$string);

        $result=json_decode($string,true);
        $count=count($result);
        //var_dump($result[0]);die;
        //print_r($result);echo count($result);die;
        include 'View/PhpMyAdmin/tableMsg.html';
    }
    //插件
    public function dialog(){
        include 'Public/dialog/index.html';
    }
    //跳转到新建页面
    public function newTable(){
        $database=$_GET['database'];
        //var_dump($database);die;
        include 'View/PhpMyAdmin/newTable.html';
    }

    //执行sql语句的页面
    public function sqlQuery(){
        include 'View/PhpMyAdmin/sqlQuery.html';
    }

    //状态页面
    public function status(){
        include 'View/PhpMyAdmin/status.html';
    }
    //账户页面
    public function zhanghu(){
        include 'View/PhpMyAdmin/zhanghu.html';
    }
}