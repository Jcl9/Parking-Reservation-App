<?php
    header("Content-Type: text/html; charset=utf8");

    if(!isset($_POST['Cancel'])){

            exit("EXECUTION ERROR!");

    }
    session_start();

    include('connect.php');
    include('reserve2.php');
    include ('reserve_revenue.php');

    $Rid = $_POST["Res_id"];
    $Lno = "SELECT Gar_level from reservation where Res_id=$Rid";
    $datecancelled = new DateTime("now");
    $datereserved = "SELECT Reserve_date from RESERVATION WHERE Res_id=$Rid";
    $interval = $datecancelled->diff($datereserved);
    $daydiff = $interval->days;
    $avai_space = "SELECT Available_space_level from GAR_LEVEL WHERE Gar_level=$Lno";
    $total_space = "SELECT Total_space from GAR_LEVEL WHERE Gar_level=$Lno";
    $updated_avai_space = mysqli_query($con,$avai_space);
    $updated_total_space = mysqli_query($con,$total_space);
    $total_revenue = $con->query($total_revenue);
    $res_fee = "SELECT res_fee FROM reservation where Res_id = $Rid";
    $updated_totalrevenue = mysqli_query($con,$total_revenue);


        $sql = "UPDATE reservation SET status = 'cancelled' WHERE Res_id = $Rid";

        if (mysqli_query($con, $sql)) {
            if ($daydiff >= 2) {
                $updated_avai_space = $avai_space + 1;
                $updated_total_space = $total_space + 1;
                $updated_totalrevenue = $total_revenue - $res_fee;
                echo "<h3>Booking cancelled and refunded.</h3>";
            }
            else {
                $updated_avai_space = $avai_space + 1;
                $updated_total_space = $total_space + 1;
                echo "<h3>Booking cancelled but not refunded.</h3>";
            }
        }
	    else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($con);
	    }

	$sql2 = "DELETE FROM reservation WHERE Res_id = $Rid";
        if (mysqli_query($con, $sql2)) {
		echo "<h3>Reservation deleted.</h3>";
            }
        else {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
            mysqli_close($con);
?>

<a href="make_reservation.html"><p>Back to the reservation page</p></a>

</body>

</html>
