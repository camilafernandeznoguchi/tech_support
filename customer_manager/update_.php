<!--Produced by: Juliana Spitzner-->

<?php
session_start();

header('Location: index.php');


//assign updated values
$id = $_SESSION["customer_id"];
// echo $id;
$newName = $_POST["first"];
$newLast = $_POST["last"];
$newAddress = $_POST["address"];
$newCity = $_POST["city"];
$newState = $_POST["state"];
$newPostal = $_POST["postal"];
//$newCountry = $_POST["country"];
//echo $newCountry;
$code = $_POST["browser"];
// echo $newCode . "HERE";
$array =$_SESSION["array"];
$newCode = array_search($code, $array);
//echo $newCode;
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
		$query = "UPDATE customers SET firstName='$newName' where customerID='$id'";
		$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));
		//update last name
		$query1 = "UPDATE customers SET lastName='$newLast' where customerID='$id'";
		$result1 = mysqli_query($con, $query1) or die('Query failed: ' . mysqli_errno($con));
		//update address
		$query2 = "UPDATE customers SET address='$newAddress' where customerID='$id'";
		$result2 = mysqli_query($con, $query2) or die('Query failed: ' . mysqli_errno($con));
		//update city
		$query3 = "UPDATE customers SET city='$newCity' where customerID='$id'";
		$result3 = mysqli_query($con, $query3) or die('Query failed: ' . mysqli_errno($con));
		//update state
		$query4 = "UPDATE customers SET state='$newState' where customerID='$id'";
		$result4 = mysqli_query($con, $query4) or die('Query failed: ' . mysqli_errno($con));
		//update postal code
		$query5 = "UPDATE customers SET postalCode='$newPostal' where customerID='$id'";
		$result5 = mysqli_query($con, $query5) or die('Query failed: ' . mysqli_errno($con));
		//update country code
		$query6 = "UPDATE customers SET countryCode='$newCode' where customerID='$id'";
		$result6 = mysqli_query($con, $query6) or die('Query failed: ' . mysqli_errno($con));
		//update phone
		$query7 = "UPDATE customers SET phone='$newPhone' where customerID='$id'";
		$result7 = mysqli_query($con, $query7) or die('Query failed: ' . mysqli_errno($con));
		//update email
		$query8 = "UPDATE customers SET email='$newEmail' where customerID='$id'";
		$result8 = mysqli_query($con, $query8) or die('Query failed: ' . mysqli_errno($con));
		//update password
		$query9 = "UPDATE customers SET password='$newPassword' where customerID='$id'";
		$result9 = mysqli_query($con, $query9) or die('Query failed: ' . mysqli_errno($con));

	}
    catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>Line" . $e->getLine();
    } finally {
        mysqli_close($con);
    }

	?>