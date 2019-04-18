<?php
session_start();
$user = '01234';

header("Content-Type: text/html; charset=utf8");
if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}
include('connect.php');

$event = $_POST['Event'];
$date = $_POST['Date'];
$pgarage = $_POST['Garage'];
$glevel = $_POST['Level'];
$status = 'Active';

$dateevent = new DateTime($date);
$datenow = new DateTime("now");
$interval = $datenow->diff($dateevent);

$daydiff = $interval->days;
if ($daydiff > 2){
    $refund = "Yes";
} else {
    $refund ="No";
}




$display_weekend="SELECT Day_of_week FROM EVENT where Event_name = '$event' and Event_date = '$date'";
$result_weekend=mysqli_query($con,$display_weekend);
$row_week = mysqli_fetch_array($result_weekend);
$weekend = $row_week[0];


$display_venue = "Select Vname From event where event_name = '$event'";
$event_venue=mysqli_query($con,$display_venue);
$row_event = mysqli_fetch_array($event_venue);
$venue = $row_event[0];


$display_garagid = "Select Gar_ID from garage where Gar_name = '$pgarage'";
$garage_query = mysqli_query($con, $display_garagid);
$row_garage = mysqli_fetch_array($garage_query);
$garage_id = $row_garage[0];


if ($weekend == 1){
    $display_price = "Select weekend_price from venue_garage where Gar_ID = '$garage_id' and vname = '$venue'";
    $price_query = mysqli_query($con, $display_price);
    $row_price = mysqli_fetch_array($price_query);
    $price = $row_price[0];
} else {
    $display_price = "Select weekday_price from venue_garage where Gar_ID = '$garage_id' and vname = '$venue'";
    $price_query = mysqli_query($con, $display_price);
    $row_price = mysqli_fetch_array($price_query);
    $price = $row_price[0];
}

$event_result = "Select Event_ID From event where event_name = '$event' and event_date = '$date'";
$event_query = mysqli_query($con, $event_result);
$row_event = mysqli_fetch_array($event_query);
$event_id = $row_event[0];
$user = 114 ;
$addreservation = "insert into reservation(Res_id,Gar_name,Gar_level,User_id,Status,Event_id,Reserve_date,Res_fee,Refundability) values (NULL,'$pgarage','$glevel','$user','$status','$event_id','$date','$price','$refund')";
$result = mysqli_query($con,$addreservation);


$reserve_result = "Select Res_ID from reservation where user_id = '$user'";
$reserve_query = mysqli_query($con, $reserve_result);
$row_reserve = mysqli_fetch_array($reserve_query);
$reserve_id = $row_reserve[0];

if($result){
    echo "Reservation was successfull! ";
    echo "Reservation id is: ", $reserve_id;
    $decrement_space = "update gar_level set Available_space_level = Available_space_level - 1 where gar_id = '$garage_id' and gar_level = '$glevel'";
    $decrement_query = mysqli_query($con,$decrement_space);
} else {
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);
?>

<a href="make_reservation.html"><p>Back to the reservation page</p></a>
<a href="reservation_main.html"><p>Back to the main page</p></a>
