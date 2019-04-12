<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}

$Event_date=$_POST['Event_date'];

include('connect.php');
$add_query="DELETE FROM EVENT WHERE Event_date = '$Event_date'";
$result=mysqli_query($con,$add_query);

if ($result){
    echo "events with date $Event_date got deleted Successfully!";
    echo "<br>";
    echo "You will be redirected to the main page in 5 seconds.";
    echo "<script type='text/javascript'>setTimeout(function(){window.location.href='event_main.html';},5000);</script>";
}else{
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);
