<?php
//Produced by: Juliana Spitzner
session_start();
	
	error_reporting(0);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	try{
		//if (empty($_POST['name']) or empty($_POST['lastName']) or empty($_POST['email']) or empty($_POST['phone']) or empty($_POST['password'])) throw new Exception("form fields not filled in");

		$customer_ID = $_POST["customerID"];
		$first_name = $_POST["firstName"];
		$last_name = $_POST["lastName"];
		$address = $_POST["address"];
		$city = $_SESSION["city1"];
		echo $city;
		$state = $_POST["state"];
		$postalcode = $_POST["postalCode"];
		$countrycode = $_POST["countryCode"];
		echo $countrycode;
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$password = $_POST["password"];

        #connect to db
		require('../model/database.php');

		if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }
        
        #$query = "UPDATE customers SET firstName='$newName', lastName='$newLast', address='$newAddress', city='$newCity', state='$newState', postalCode='$newPostal', countryCode='$newCode', phone='$newPhone', email='$newEmail', password='$newPassword' WHERE customerID='$customer_ID'";
		$query = "UPDATE customers SET city='$city' where customerID='$customer_ID'";

    	if (mysqli_query($con, $query)) {
          echo "Record added successfully";
          header('Location: viewupdateCustomer.php');
        }
        else {
          echo "Error adding record: " . mysqli_error($con);
        }
        

	} catch (Exception $e) {
		header("Refresh:5; url=viewupdateCustomer.php");
		echo "Error: " . $e->getMessage() . "<br>Line " . $e->getLine();
		echo "<br> You will be redirected in 5 seconds...";

	} finally {
		// close connection
    	mysqli_close($con);
	}
	

?>