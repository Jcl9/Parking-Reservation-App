<?php
header("Content-Type: text/html; charset=utf8");

include('connect.php');

// this is the go back ot main page component!
echo '<form action="event_main.html" method="post">
    <p><input type="submit" name="submit" value="click here to go back to main page">
    </p>
</form>';

echo "hello! total event number is:";
echo "<br>";

$display_all="SELECT Event_ID,Event_name,Event_date,Day_of_week,Distance_garage FROM EVENT";
$result=mysqli_query($con,$display_all);

$table_size = mysqli_num_rows($result);

echo $table_size;
echo "<br>";

echo "<br>";

mysqli_close($con);
?>