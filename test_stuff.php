<?php

include('connect.php');

$event = 'Frozen';
$date = '2019-04-27';
$pgarage = 'GarageA';

$display_weekend="SELECT Day_of_week FROM EVENT where Event_name = '$event' and Event_date = '$date'";
$result_weekend=mysqli_query($con,$display_weekend);
if ($row = mysqli_fetch_array($result_weekend)){
    echo " Weekend is", "$row[0]";
    $weekend = $row[0];
    echo $weekend;
}

$display_venue = "Select Vname From event where event_name = '$event'";
$event_venue=mysqli_query($con,$display_venue);
$row_event = mysqli_fetch_array($event_venue);
$venue = $row_event[0];
echo " ", $venue;

$display_garagid = "Select Gar_ID from garage where Gar_name = '$pgarage'";
$garage_query = mysqli_query($con, $display_garagid);
$row_garage = mysqli_fetch_array($garage_query);
$garage_id = $row_garage[0];
echo " GarageID: ", $garage_id;

if ($weekend == 1){
    $display_price = "Select weekend_price from venue_garage where Gar_ID = '$garage_id' and vname = '$venue'";
    $price_query = mysqli_query($con, $display_price);
    $row_price = mysqli_fetch_array($price_query);
    $price = $row_price[0];
    echo "  Price is : $",$price;
} else {
    $display_price = "Select weekday_price from venue_garage where Gar_ID = '$garage_id' and vname = '$venue'";
    $price_query = mysqli_query($con, $display_price);
    $row_price = mysqli_fetch_array($price_query);
    $price = $row_price[0];
    echo "  Price is : $",$price;
}

$event_result = "Select Event_ID From event where event_name = '$event' and event_date = '$date'";
$event_query = mysqli_query($con, $event_result);
$row_event = mysqli_fetch_array($event_query);
$event_id = $row_event[0];

echo "  EventID is ", $event_id;

$start_date = '2019-04-27';
$end_date = '2019-04-28';

$display_price="SELECT res_fee FROM reservation where reserve_date = '$start_date'";
$result_price=mysqli_query($con,$display_price);
$total_revenue = 0;

while ($row_price = mysqli_fetch_array($result_price)){
    $price = $row_price[0];
    echo "Price are $" ,$price , "<br>";
    $total_revenue = $total_revenue + $price;
}

?>