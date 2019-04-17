<?php
header("Content-Type: text/html; charset=utf8");

include('connect.php');
echo "hello! event dates are:";
echo "<br>";

$eventname=$_POST['Event'];

$display_all="SELECT * FROM EVENT_DATE where Event_name is ". $eventname;
$result=mysqli_query($con,$display_all);

while($row1 = mysqli_fetch_array($result)){
    echo $row1[2];
}

?>