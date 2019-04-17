<?php
header("Content-Type: text/html; charset=utf8");

if(!isset($_POST['submit'])){
    exit("EXECUTION ERROR!");
}

echo '<form action="event_main.html" method="post">
    <p><input type="submit" name="submit" value="click here to go back to main page">
    </p>
</form>';

$Event_name=$_POST['Event_name'];

include('connect.php');
$add_query="SELECT * FROM EVENT WHERE Event_name = '$Event_name'";
$result=mysqli_query($con,$add_query);

while($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $cname => $cvalue) {
        echo "$cname: $cvalue ";
        echo "<br>";
    }
}


mysqli_close($con);
