<?php
/**
 * Created by PhpStorm.
 * User: 师鹏程
 * Date: 2018/8/30
 * Time: 12:45
 */
class db{
    private static $link,$result;//定义静态私有变量 使其可以保存值和在本类中访问
    public function __construct($config)//构造函数
    {



        //链接数据库
        self::$link=mysqli_connect(
            $config['dsn'],
            $config['username'],
            $config['password'],
            $config['database']


            );
    }

    public function query($sql){
        //var_dump($sql);die;
        //链接数据库  执行sql语句
        self::$result=mysqli_query(self::$link,$sql);


        //返回结果
        return $this;
    }
    public function fetchAll(){
        //将结果转为数组
        return mysqli_fetch_all(self::$result,MYSQLI_ASSOC);
    }
    public function fetchOne(){
        //将结果转为数组
        return mysqli_fetch_array(self::$result,MYSQLI_ASSOC);
    }
    //插入  传值：表名 数组：插入的值
    public function insert($tableName,$array=array()){
        $v='(';
        foreach ($array as $key=>$value){
            //判断每一列的值  是否是字符串
            if(is_string($value)){
                $value="'".$value."'";//为字符串加上引号
            }
            //判断值是否为空
            if(empty($value)){
                //为空拼接上 null
                $v.='null';
            }
            //拼接上值 和逗号
            $v.=$value.',';
        }
        //去除最右边的逗号
        $v=rtrim($v,",");
        $v.=')';
        //插入的sql语句
        $sql='insert into '.$tableName.' values '.$v;
        echo $sql;
//        $this->query($sql);
        //执行sql
        mysqli_query(self::$link,$sql);
        //返回最后插入的id
        return mysqli_insert_id(self::$link);

    }

    //修改 参数为：表名  值 条件
    public function update($tableName,$array=array(),$condition=''){
        $v='';
        foreach ($array as $key=>$value){
            if(is_string($value)){
                $value="'".$value."'";
            }
            $v.=$key.'='.$value.",";

        }
        $v=rtrim($v,",");
        //修改语句
        $sql='update '.$tableName.' set '.$v.' where '.$condition;
        echo $sql;
        //执行语句
        $this->query($sql);
    }

    //删除  表名 条件
    public function delete($tableName,$condition){
        //删除语句
        $sql='delete from '.$tableName.' where '.$condition;
        echo $sql;
        $this->query($sql);
    }
}