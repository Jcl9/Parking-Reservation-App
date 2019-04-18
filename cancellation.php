<?php
    header("Content-Type: text/html; charset=utf8");

    if(!isset($_POST['Cancel'])){

            exit("EXECUTION ERROR!");

    }

    $Rid = $_POST["Rid"];
    $Lno = "SELECT Gar_level from reservation where Rid=$Rid";
    $datecancelled = new DateTime("now");
    $datereserved = "SELECT Reserve_date from RESERVATION WHERE Rid=$Rid";
    $interval = $datecancelled->diff($datereserved);
    $daydiff = $interval->days;
    $avai_space = "SELECT Available_space_level from GAR_LEVEL WHERE Gar_level=$Lno";
    $totalspace = "SELECT Total_space from GAR_LEVEL WHERE Gar_level=$Lno";

    include('connect.php');
    include('reserve.php');



		if ($daydiff > 2) {
            $sql = "UPDATE reservation SET status = 'cancelled & refunded' WHERE Rid = $Rid";
            if (mysqli_query($con, $sql)) {

                $query = mysql_query("UPDATE gar_level SET Available_space_level = $avai_space +1 WHERE Gar_level = $Lno");
                $query2 = mysql_query("UPDATE gar_level SET Total_space = $totalspace +1 WHERE Gar_level = $Lno");
                echo "<h3>Booking cancelled and refunded.</h3>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
		else{
		   	$sql = "UPDATE reservation SET status = 'cancelled' WHERE Rid = $Rid";
			if (mysqli_query($con, $sql)) {

                $query = mysql_query("UPDATE gar_level SET Available_space_level = $avai_space +1 WHERE Gar_level = $Lno");
                $query2 = mysql_query("UPDATE gar_level SET Total_space = $totalspace +1 WHERE Gar_level = $Lno");
				echo "<h3>Booking cancelled but not refunded.</h3>";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
        }
		$sql2 = "DELETE FROM reservation WHERE Rid = $Rid";
            if (mysqli_query($con, $sql2)) {
                echo "<h3>Booking deleted.</h3>";
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
            mysqli_close($con);
?>

<a href="reserve.php"><p>Back to the reservation page</p></a>

</body>

</html>
