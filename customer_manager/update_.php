<!--Produced by: Juliana Spitzner-->

<?php
session_start();

header('Location: index.php');


//assign updated values
$id = $_SESSION["customer_id"];
echo $id;
$newName = $_POST["first"];
$newLast = $_POST["last"];
$newAddress = $_POST["first"];
$newCity = $_POST["city"];
$newState = $_POST["state"];
$newPostal = $_POST["postal"];
$newCountry = $_POST["country"];
echo $newCountry;
$newPhone = $_POST["phone"];
$newEmail = $_POST["email"];
$newPassword = $_POST["password"];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    error_reporting(0);

    try {
        # Conect to database
        require('../model/database.php');

        # Check connection
        if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }

		//update first name
		$query = "UPDATE customers SET firstName='$newName' where customerID='1118'";
		$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));
		//update last name
		$query1 = "UPDATE customers SET lastName='$newLast' where customerID='1118'";
		$result1 = mysqli_query($con, $query1) or die('Query failed: ' . mysqli_errno($con));
		//update address
		$query2 = "UPDATE customers SET address='$newAddress' where customerID='1118'";
		$result2 = mysqli_query($con, $query2) or die('Query failed: ' . mysqli_errno($con));
		//update city
		$query3 = "UPDATE customers SET city='$newCity' where customerID='1118'";
		$result3 = mysqli_query($con, $query3) or die('Query failed: ' . mysqli_errno($con));
		//update state
		$query4 = "UPDATE customers SET state='$newState' where customerID='1118'";
		$result4 = mysqli_query($con, $query4) or die('Query failed: ' . mysqli_errno($con));
		//update postal code
		$query5 = "UPDATE customers SET postalCode='$newPostal' where customerID='1118'";
		$result5 = mysqli_query($con, $query5) or die('Query failed: ' . mysqli_errno($con));
		//update country code
		$query6 = "UPDATE customers SET countryCode='$newCountry' where customerID='1118'";
		$result6 = mysqli_query($con, $query6) or die('Query failed: ' . mysqli_errno($con));
		//update phone
		$query7 = "UPDATE customers SET phone='$newPhone' where customerID='1118'";
		$result7 = mysqli_query($con, $query7) or die('Query failed: ' . mysqli_errno($con));
		//update email
		$query8 = "UPDATE customers SET email='$newEmail' where customerID='1118'";
		$result8 = mysqli_query($con, $query8) or die('Query failed: ' . mysqli_errno($con));
		//update password
		$query9 = "UPDATE customers SET password='$newPassword' where customerID='1118'";
		$result9 = mysqli_query($con, $query9) or die('Query failed: ' . mysqli_errno($con));

	}
    catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>Line" . $e->getLine();
    } finally {
        mysqli_close($con);
    }

	?>