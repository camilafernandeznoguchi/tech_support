<?php
	
	error_reporting(0);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	try{
		if (empty($_POST['name']) or empty($_POST['lastName']) or empty($_POST['email']) or empty($_POST['phone']) or empty($_POST['password'])) throw new Exception("form fields not filled in");
        $name = $_POST['name'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
        $password = $_POST['password'];

		$con = mysqli_connect("webdev.bentley.edu", "fernandcami", "2303", "fernandcami");

		if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }
        
        $query = "INSERT INTO TECHNICIANS (firstName, lastName, email, phone, password) VALUES ('$name', '$lastName', '$email', '$phone', '$password')";
        
    	if (mysqli_query($con, $query)) {
          #echo "Record added successfully";
          header('Location: index.php');
        }
        else {
          echo "Error adding record: " . mysqli_error($con);
        }
        

	} catch (Exception $e) {
		// not sure this is enough
		$message = $e->getMessage();
	    $code = $e->getCode();
	    header("Location: error.php?code=$code&message=$message");
	} finally {
		// close connection
    	mysqli_close($con);
	}
	

?>