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
        $search_sql = "select * from customer where User_id = '$uid' and Password='$pwd'";
        $result = mysqli_query($con, $search_sql);
        $rows = mysqli_num_rows($result);
        if ($rows) {
            header("refresh:0;url=TEMP_Main_Page.html");//You should change the url once the main function page is completed
            exit;
        } else {
            echo "Incorrect User_id or Password!";
            echo "<br>";
            echo "You will be redirected to the login page in 3 seconds.";
            echo "<script type='text/javascript'>setTimeout(function(){window.location.href='login.html';},3000);</script>";
        }
    }
    mysqli_close($con);
?>
