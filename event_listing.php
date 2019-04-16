<?php
header("Content-Type: text/html; charset=utf8");

include('connect.php');
echo "hello! total event number is:";
echo "<br>";

$display_all="SELECT * FROM EVENT";
$result=mysqli_query($con,$display_all);


$table_size = mysqli_num_rows($result);

echo $table_size;
echo "<br>";


for ($x = 0; $x <= 5; $x++) {
    $row = $result->fetch_assoc();
    foreach ($row as $cname => $cvalue) {
        echo "$cname: $cvalue    |    ";
    }
    echo "<br>";
}


echo "<br>";

mysqli_close($con);
?>