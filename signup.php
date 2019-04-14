<?php
    header("Content-Type: text/html; charset=utf8");

    if(!isset($_POST['submit'])){
            exit("EXECUTION ERROR!");
    }

    $fname=$_POST['Fname'];
    $Lname=$_POST['Lname'];
    $uid = $_POST['User_id'];
    $pwd = $_POST['Password'];
    $phone = $_POST['Phone_num'];
    $vid = $_POST['Vehicle_id'];
    $vtype = $_POST['Vehicle_Type'];
    if (empty($phone))
    {
        $phone = 0;
    }

    include('connect.php');
    $addquery="insert into customer(Fname,Lname,User_id,Password,Phone_num,Vehicle_id,Vehicle_type,admin) values ('$fname','$Lname','$uid','$pwd','$phone','$vid','$vtype','0')";
    $result=mysqli_query($con,$addquery);

    if ($result){
        echo "Successfully Registered!";
        echo "<br>";
        echo "You will be redirected to the login page in 3 seconds.";
        echo "<script type='text/javascript'>setTimeout(function(){window.location.href='login.html';},3000);</script>";
    }else{
        die('Error: ' . mysqli_error($con));
    }

    mysqli_close($con);
?>