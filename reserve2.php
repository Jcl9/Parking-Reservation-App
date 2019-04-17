<?php
    include('connect.php');
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST['submit'])){
            exit("EXECUTION ERROR!");
    }

    $event = $_POST['Event'];
    $date = new DateTime($_POST['Date']);
    $pgarage = $_POST['Garage'];
    $glvl = $_POST['Level'];
    $fee = $_POST['Fee'];
    $status = 'Active';
    
    $datenow = new DateTime("now");
    $interval = $datenow->diff($date);
    
    $daydiff = $interval->days;
    if ($daydiff > 2){
       $refund = "Yes";
    } else {
       $refund ="No";
    }   

    $query = "SELECT * FROM 'Event'";

    $addreservation = "insert into reservation(Res_id,Gar_name,User_id,Status,Event,Start_date,End_date,Res_fee,Refundability) values (NULL,'$pgarage','##','$status','$event','$date','$date','$fee','$refund')";
    $result = mysqli_query($con,$addreservation);

    if($result){
      echo "Reservation was successfull!";
      
    } else {
      die('Error: ' . mysqli_error($con));
    }
    
    mysqli_close($con);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parking Reservation</title>
</head>
<body>
<form action="reserve.php" method="post">
    <p>Event*:
        <select name="event" onChange="submit">
            <option>Concert</option>
            <option>Football</option>
            <option>Soccer</option>
        </select>
    </p>
    <p>Date*(Year-Month-Day):
        <select name="days" onChange="submit">
            <option>2019-05-01</option>
            <option>2019-06-22</option>
        </select>
    </p>
    <p>Parking Garage*:
        <select name="garage" onChange="submit">
            <option>GarageA</option>
            <option>GarageB</option>
        </select>
    </p>
    <p>Asterisk (*) indicates required fields</p>
    <p><input type="submit" name="submit" value="submit"></p>
</form>
</body>
</html>

