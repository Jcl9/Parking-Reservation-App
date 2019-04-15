<?php
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
    $confirm_number = rand(1000,5000);
    
    $datenow = new DateTime("now");
    $interval = $datenow->diff($date);
    
    $daydiff = $interval->days;
    if ($daydiff > 2){
       $refund = "Yes";
    } else {
       $refund ="No";
    }   

    include('connect.php');
    $events = "select * from 'project1.event'";
    $eventlist = mysqli_query($con,$events);
    $garages = "select * from 'project1.gar_distance'";
    $garageslist = mysqli_query($con,$garages);

    $addreservation = "insert into reservation(Res_id,Gar_name,User_id,Status,Event,Start_date,End_date,Res_fee,Refundability) values ('$confirm_number','$pgarage','##','$status','$event','$date','$date','$fee','$refund')";
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
            <?php while($row1 = mysqli_fetch_array($eventlist)):; ?>
            <option><?php echo $row1[2]; ?></option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>Date*(Year-Month-Day):
        <select name="days" onChange="submit">
            <?php while($row1 = mysqli_fetch_array($eventlist)):; ?>
            <option ><?php echo $row1[3]; ?></option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>Parking Garage*:
        <select name="garage" onChange="submit">
            <?php while($row1 = mysqli_fetch_array($garageslist)):; ?>
                <option ><?php echo $row1[1],$row1[2]," miles" , $row1[4], "dollars" ; ?></option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>Asterisk (*) indicates required fields</p>
    <p><input type="submit" name="submit" value="submit"></p>
</form>
</body>
</html>

