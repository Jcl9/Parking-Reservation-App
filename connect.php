<?php
    $server="localhost";//主机
    $db_username="phpuser";//你的数据库用户名
    $db_password="phpwd";//你的数据库密码

    $con = mysqli_connect($server,$db_username,$db_password,'project1');//链接数据库
    if(!$con){
        die("can't connect".mysqli_connect_error());//如果链接失败输出错误
    }

    mysqli_select_db($con,'project1');//选择数据库（我的是test）
?>