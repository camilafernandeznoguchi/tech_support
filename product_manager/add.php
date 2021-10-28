<?php
	
	error_reporting(0);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	try{
		if (empty($_POST['code']) or empty($_POST['name']) or empty($_POST['version']) or empty($_POST['release'])) throw new Exception("form fields not filled in");
		$code = $_POST['code'];
		$name = $_POST['name'];
		$version = $_POST['version'];
		$release = $_POST['release'];

		$con = mysqli_connect("webdev.bentley.edu", "fernandcami", "2303", "fernandcami");

		if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }

        $query = "INSERT INTO PRODUCTS VALUES ('$code', '$name', $version, '$release')";

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