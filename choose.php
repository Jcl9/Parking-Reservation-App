<?php
header("Content-Type: text/html; charset=utf8");

include('connect.php');
echo "hello! event dates are:";
echo "<br>";


$display_date="SELECT * FROM EVENT";
$result=mysqli_query($con,$display_date);

while($row1 = mysqli_fetch_array($result)){
    echo $row1[2] ," Event:", $row1[1], " Location: ",$row1[4];
    echo "<br>";
}

echo "Garage available are";
echo "<br>";


$display_garage = "SELECT * FROM GARAGE";
$result_garage = mysqli_query($con, $display_garage);

while($row2 = mysqli_fetch_array($result_garage)){
    echo $row2[1] , " Garage ID: ",$row2[0] ," Levels: ", $row2[2];
    echo "<br>";
}




$display_distance = "SELECT * FROM venue_garage";
$result_distance = mysqli_query($con,$display_distance);
echo "Distances of venue from garages according to garage id are <br>";

while ($row4 = mysqli_fetch_array($result_distance)){
    echo $row4[0], "  GarageID:" , $row4[1], " Distance ", $row4[2] ;
    echo "<br>";
}


?>