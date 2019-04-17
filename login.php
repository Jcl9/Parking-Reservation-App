<?php
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST["submit"])){
        exit("EXECUTION ERROR!");
    }

    include('connect.php');
    $uid = $_POST['User_id'];
    $pwd= $_POST['Password'];

    if (!$uid || !$pwd){
        echo "The login information is incomplete!";
        echo "<br>";
        echo "You will be redirected to the login page in 3 seconds.";
        echo "<script type='text/javascript'>setTimeout(function(){window.location.href='login.html';},3000);</script>";
    }else {
        $search_sql = "select * from customer where User_id = '$uid' and Password='$pwd' and admin = '0'";
        $search_sql_admin = "select * from customer where User_id = '$uid' and Password='$pwd' and admin = '1'";
        $result = mysqli_query($con, $search_sql);
        $result_admin = mysqli_query($con, $search_sql_admin);
        $rows = mysqli_num_rows($result);
        $rows_admin = mysqli_num_rows($result_admin);
        if ($rows) {
            header("refresh:0;url=TEMP_Main_Page.html");//user's page
            exit;
        } else if($rows_admin){
            header("refresh:0;url=event_main.html");//admin's page
            exit;
        } else{
            echo "Incorrect User_id or Password!";
            echo "<br>";
            echo "You will be redirected to the login page in 3 seconds.";
            echo "<script type='text/javascript'>setTimeout(function(){window.location.href='login.html';},3000);</script>";
        }
    }
    mysqli_close($con);
?>
