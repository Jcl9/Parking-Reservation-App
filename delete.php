<?php

    include('connect.php');
    include('reserve2.php');


    $Rid = intval(htmlspecialchars($_POST["Rid"]));

		$sql = "DELETE FROM $reservation WHERE Rid = $Rid";
		if (mysqli_query($conn, $sql)) {
			echo "<h3>Booking deleted.</h3>";
		}
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		mysqli_close($conn);
?>

<a href="reserve2.php"><p>Back to the reservation page</p></a>

</body>

</html>
