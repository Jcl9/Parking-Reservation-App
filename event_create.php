<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}

$Event_name=$_POST['Event_name'];
$Day_of_week=$_POST['Day_of_week'];
$Event_price = $_POST['Event_price'];

if (empty($Event_price))
{
    $Event_price = 0;
}

include('connect.php');
$add_query="insert into EVENT(Event_name,Day_of_week,Event_price) values ('$Event_name','$Day_of_week','$Event_price')";
$result=mysqli_query($con,$add_query);

if ($result){
    echo "event created Successfully!";
    echo "<br>";
    echo "You will be redirected to the main page in 1 seconds.";
    echo "<script type='text/javascript'>setTimeout(function(){window.location.href='event_main.html';},1000);</script>";
}else{
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);
?>