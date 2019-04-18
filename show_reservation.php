<?php
session_start();
$user = $_SESSION['name'];

include('connect.php');

$display_reserve="SELECT * FROM Reservation where User_id = '$user'";
$result_reserve=mysqli_query($con,$display_reserve);

while ($row_reserve = mysqli_fetch_array($result_reserve)){
    echo "ReservationID: " , $row_reserve[0], "  Garage: ",$row_reserve[1], "  Reservation Date: ", $row_reserve[6], "  Fee: ", $row_reserve[7] , "  Status:" , $row_reserve[4], "<br>";
}


?>


