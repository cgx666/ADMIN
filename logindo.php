<?php

    //页面编码
    header("Content-type:text/html;charset=utf8");

    //引入公用配置文件
    require_once('include/common.in.php');

    //引入公用函数文件
    require_once('include/common.fn.php');

    $username = trim($username);
    //检查数据库是否连接成功
    // $res = $msql->isConnect();
    // echo $res;

    //接收表单数据 
    // $username = addslashes($_POST['username']); //对特殊字符进行转义
    // $pwd = addslashes($_POST['pwd']);

    // echo $username.$pwd;

    //对数据进行验证

    //1.规范性验证
    if(!preg_match('/^[A-Z]{6}$/',$username)){
        echo '用户名不规范';
        die();
    } else if(!$pwd){
        echo '请输入密码';
        die();
    }else{
        //2.数据库验证
        $uname = substr(sha1($username),0,23);
        $pwd = substr(sha1($pwd),0,23);
        //sql语句
        $sql = "SELECT count(*) as total FROM cgx_admin WHERE uname='".$uname."'AND pwd='".$pwd."'";
        //执行语句
        $msql -> execute($sql);

        //获取执行结果
        $arr = $msql ->fetchquery();

        //判断返回结果
        if($arr['total']){
            echo '登录成功';

            //创建session(进入入口文件的通行证)
            $_SESSION['admin'] = $username;

            //进入入口文件
            jump('main.php');
        }else{
            echo '登录失败！！';
        }
    }

    //3.验证通过后分配session


?>