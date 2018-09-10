<?php
/**
 * Created by PhpStorm.
 * User: 师鹏程
 * Date: 2018/8/30
 * Time: 9:34
 */
class A{
    function B(){
        //var_dump($GLOBALS['db']);
        //使用实例化出 的新对象 （全局） 调用方法query 执行sql语句
        //查询
//        $a=$GLOBALS['db']->query('show tables;')->fetchAll();

        //添加
        $a=$GLOBALS['db']->insert('text',array('id'=>null,'rbac'=>'aaa','num'=>'sss','sort'=>'dsd'));
        var_dump($a);
        //修改
        //$GLOBALS['db']->update('text',array('num'=>'aaa'),"id=5");
        //删除
//        $GLOBALS['db']->delete('text',"id=5");
        include 'View/list.html';
    }
    function C(){
        include 'View/welcome.html';
    }
}