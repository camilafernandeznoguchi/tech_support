<?php
	//Produced by: Camila Fernandez Noguchi

	error_reporting(0);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	try{
		if (empty($_POST['code']) or empty($_POST['name']) or empty($_POST['version']) or empty($_POST['release'])) throw new Exception("form fields not filled in");
		$code = $_POST['code'];
		$name = $_POST['name'];
		$version = $_POST['version'];
		$release = $_POST['release'];

		#Connect to db
		require('../model/database.php');

		if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }

        $query = "INSERT INTO PRODCTS VALUES ('$code', '$name', $version, '$release')";

    	if (mysqli_query($con, $query)) {
          #echo "Record added successfully";
          header('Location: index.php');
        }
        else {
          echo "Error adding record: " . mysqli_error($con);
        }

	} catch (Exception $e) {
		//header("Refresh:5; url=addProduct.php");
		//echo "Error: " . $e->getMessage() . "<br>Line " . $e->getLine();
		//echo "<br> You will be redirected in 5 seconds...";
		$error_message = $e->getMessage() . "<br>Line" . $e->getLine();
        echo "<form action='../errors/database_error.php' method='post'>";
        echo "<input type='hidden' name='error' value=\"".$error_message."\" >";
        echo "</form>";
        header("Location: ../errors/database_error.php?error=".$error_message);
	} finally {
		// close connection
    	mysqli_close($con);
	}
	

?>