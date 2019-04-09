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

    include('connect.php');
    $addquery="insert into customer(Fname,Lname,User_id,Password,Phone_num,Vehicle_id,Vehicle_type) values ('$fname','$Lname','$uid','$pwd','$phone','$vid','$vtype')";
    $result=mysqli_query($con,$addquery);

    if ($result){
        echo "Successfully Registered!";
    }else{
        die('Error: ' . mysqli_error($con));
    }

    mysqli_close($con);
?>