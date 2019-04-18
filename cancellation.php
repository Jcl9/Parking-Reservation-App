<?php
    header("Content-Type: text/html; charset=utf8");

    if(!isset($_POST['Cancel'])){

            exit("EXECUTION ERROR!");

    }

    $Rid = $_POST["Res_id"];
    $Lno = "SELECT Gar_level from reservation where Res_id=$Rid";
    $datecancelled = date('Y-m-d');
    $datereserved = "SELECT Reserve_date from RESERVATION WHERE Res_id=$Rid";
    $interval = $datecancelled->diff($datereserved);
    $daydiff = $interval->days;
    $avai_space = "SELECT Available_space_level from GAR_LEVEL WHERE Gar_level=$Lno";
    $totalspace = "SELECT Total_space from GAR_LEVEL WHERE Gar_level=$Lno";

    include('connect.php');
    include('reserve2.php');



		if ($daydiff > 2) {
            $sql = "UPDATE reservation SET status = 'cancelled & refunded' WHERE Res_id = $Rid";
            if (mysqli_query($con, $sql)) {

                $query = mysql_query("UPDATE gar_level SET Available_space_level = $avai_space +1 WHERE Gar_level = $Lno");
                $query2 = mysql_query("UPDATE gar_level SET Total_space = $totalspace +1 WHERE Gar_level = $Lno");
                echo "<h3>Booking cancelled and refunded.</h3>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
		else{
		   	$sql = "UPDATE reservation SET status = 'cancelled' WHERE Res_id = $Rid";
			if (mysqli_query($con, $sql)) {

                $query = mysql_query("UPDATE gar_level SET Available_space_level = $avai_space +1 WHERE Gar_level = $Lno");
                $query2 = mysql_query("UPDATE gar_level SET Total_space = $totalspace +1 WHERE Gar_level = $Lno");
				echo "<h3>Booking cancelled but not refunded.</h3>";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
        }
		$sql2 = "DELETE FROM reservation WHERE Res_id = $Rid";
            if (mysqli_query($con, $sql2)) {
                echo "<h3>Booking deleted.</h3>";
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
            mysqli_close($con);
?>

<a href="make_reservation.html"><p>Back to the reservation page</p></a>

</body>

</html>
