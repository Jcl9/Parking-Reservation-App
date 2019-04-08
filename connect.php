<?php
    $server="localhost";
    $db_username="phpuser";
    $db_password="phpwd";

    $con = mysqli_connect($server,$db_username,$db_password,'project1');
    if(!$con){
        die("can't connect".mysqli_connect_error());
    }

    mysqli_select_db($con,'project1');
?>