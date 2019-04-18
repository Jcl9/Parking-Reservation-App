<?php
session_start();

header("Content-Type: text/html; charset=utf8");
if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}
include('connect.php');

$start_date = $_POST['Date'];
$end_date = $_POST['Date2'];

$display_price="SELECT res_fee FROM reservation where reserve_date = '$start_date'";
$result_price=mysqli_query($con,$display_price);
$total_revenue = 0;



while ($row_price = mysqli_fetch_array($result_price)){
    $price = $row_price[0];
    $total_revenue = $total_revenue + $price;
}

$display_price2="SELECT res_fee FROM reservation where reserve_date = '$end_date'";
$result_price2=mysqli_query($con,$display_price2);

while ($row_price = mysqli_fetch_array($result_price2)){
    $price = $row_price[0];
    $total_revenue = $total_revenue + $price;
}

echo "The total revenue for dates: '$start_date' and '$end_date' is: $", $total_revenue;


mysqli_close($con);
?>
