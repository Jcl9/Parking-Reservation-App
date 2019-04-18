<?php

include('connect.php');

$event = 'Frozen';
$date = '2019-05-04';

$display_weekend="SELECT Day_of_week FROM EVENT where Event_name = '$event' and Event_date is '$date'";
$result_weekend=mysqli_query($con,$display_weekend);

echo " Weekend is", "$result_weekend";

?>