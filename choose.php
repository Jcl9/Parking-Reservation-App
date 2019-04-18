<?php
header("Content-Type: text/html; charset=utf8");

include('connect.php');
echo "hello! event dates are:";
echo "<br>";


$display_date="SELECT * FROM EVENT";
$result=mysqli_query($con,$display_date);

while($row1 = mysqli_fetch_array($result)){
    echo $row1[2];
    echo "<br>";
}

echo "Garage availables are";
echo "<br>";


$display_garage = "SELECT * FROM GARAGE";
$result_garage = mysqli_query($con, $display_garage);

while($row2 = mysqli_fetch_assoc($result_garage)){
    foreach ($row2 as $cname => $cvalue) {
        echo "$cname: $cvalue ";

    }
    echo "<br>";
}



$row3 = mysqli_fetch_assoc($result);
$display_distance = "SELECT * FROM venue_garage_distance where vname = '". $row3[5] . "' ";
$result_distance = mysqli_query($con,$display_distance);
echo "Distances of venue from garages according to garage id are";

while ($row4 = mysqli_fetch_assoc($result_distance)){
    echo "GarageID:" , $row4[2], " Distance ", $row4[3] ;
}


?>