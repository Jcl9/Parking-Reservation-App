<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}

$Event_name=$_POST['Event_name'];
$Event_date=$_POST['Event_date'];
$Day_of_week=$_POST['Day_of_week'];
$Venue = $_POST['Venue'];


include('connect.php');
$add_query="insert into event(Event_ID, Event_name,Event_date,Day_of_week,Vname) values (NULL,'$Event_name','$Event_date','$Day_of_week','$Venue')";
$result=mysqli_query($con,$add_query);


echo "<br>";

$add_query="SELECT * FROM EVENT WHERE Event_name = '$Event_name'";
$result=mysqli_query($con,$add_query);

while($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $cname => $cvalue) {
        echo "$cname: $cvalue ";
        echo "<br>";
    }
}

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