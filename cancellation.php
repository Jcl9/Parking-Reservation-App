<?php
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST['Cancel'])){
            exit("EXECUTION ERROR!");
    }
    $datecancelled = new DateTime("now");
    $datereserved = $_POST("date");
    $interval = $datecancelled->diff($datereserved);
    $daydiff = $interval->days;
    $avai_space = $_POST("Avai_space");

    include('connect.php');
    include('reserve2.php');


    $Rid = intval(htmlspecialchars($_POST["Rid"]));
		if ($daydiff > 2){
		   	$sql = "UPDATE reservation SET status = 'cancelled & refunded' WHERE Rid = $Rid";
			if (mysqli_query($con, $sql)) {
				
				$avai_space = $avai_space + 1
				echo "<h3>Booking cancelled and refunded.</h3>";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
		}
		else{
		   	$sql = "UPDATE reservation SET status = 'cancelled' WHERE Rid = $Rid";
			if (mysqli_query($con, $sql)) {
				
				$avai_space = $avai_space + 1
				echo "<h3>Booking cancelled but not refunded.</h3>";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
		
			mysqli_close($con);
	}
?>

<a href="reserve2.php"><p>Back to the reservation page</p></a>

</body>

</html>
