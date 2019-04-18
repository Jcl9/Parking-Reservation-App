<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}

$Gar_id=$_POST['Gar_id'];
$Gar_level=$_POST['Gar_level'];
$Event_id=$_POST['Event_id'];

$Price=$_POST['Price'];


include('connect.php');
$add_query="UPDATE GARAGE_LEVEL_EVENT_DATE SET Price = '$Price' WHERE Event_id = '$Event_id' AND Gar_level = '$Gar_level' AND Gar_id = '$Gar_id' ";
$result=mysqli_query($con,$add_query);


echo "<br>";
echo "data changed Successfully, here is the new profile for this event: ";
echo "<br>";
echo "<br>";

$add_query="SELECT * FROM EVENT WHERE Event_id = '$Event_id' AND Gar_level = '$Gar_level' AND Gar_id = '$Gar_id' ";
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