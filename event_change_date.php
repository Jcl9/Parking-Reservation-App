<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}

$Event_ID=$_POST['Event_ID'];
$Event_date=$_POST['Event_date'];


include('connect.php');
$add_query="UPDATE EVENT SET Event_date = '$Event_date' WHERE Event_ID = '$Event_ID'";
$result=mysqli_query($con,$add_query);


echo "<br>";
echo "date changed Successfully, here is the new profile for this event: ";
echo "<br>";
echo "<br>";

$add_query="SELECT * FROM EVENT WHERE Event_ID = '$Event_ID'";
$result=mysqli_query($con,$add_query);

$row = mysqli_fetch_assoc($result);
    foreach ($row as $cname => $cvalue) {
        echo "$cname: $cvalue ";
        echo "<br>";
}
echo "<br>";
echo "<br>";
if ($result){
    echo "You will be redirected to the main page in 10 seconds.";
    echo "<script type='text/javascript'>setTimeout(function(){window.location.href='event_main.html';},10000);</script>";
}else{
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);
?>