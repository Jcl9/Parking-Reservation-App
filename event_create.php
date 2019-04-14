<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}

$Event_name=$_POST['Event_name'];
$Event_date=$_POST['Event_date'];
$Day_of_week=$_POST['Day_of_week'];
$Distance_garage = $_POST['Distance_garage'];


include('connect.php');
$add_query="insert into EVENT(Event_ID, Event_name,Event_date,Day_of_week,Distance_garage) values (NULL,'$Event_name','$Event_date','$Day_of_week','$Distance_garage')";
$result=mysqli_query($con,$add_query);

$display_added="SELECT * FROM EVENT WHERE Event_name = '$Event_name' and Event_date = '$Event_date'";
$added=mysqli_query($con,$display_added);

$row = $added->fetch_assoc();

foreach($row as $cname => $cvalue){
    print "$cname: $cvalue   <br> \t";
}

echo "<br>";


if ($result){
    echo "event created Successfully!";
    echo "<br>";
    echo "You will be redirected to the main page in 10 seconds.";
    echo "<script type='text/javascript'>setTimeout(function(){window.location.href='event_main.html';},10000);</script>";
}else{
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);
?>