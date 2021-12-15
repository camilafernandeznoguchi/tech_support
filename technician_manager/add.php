<?php
	//Produced by: Camila Fernandez Noguchi
	error_reporting(0);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	try{
		if (empty($_POST['name']) or empty($_POST['lastName']) or empty($_POST['email']) or empty($_POST['phone']) or empty($_POST['password'])) throw new Exception("form fields not filled in");

        $name = $_POST['name'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
        $password = $_POST['password'];

        #connect to db
		require('../model/database.php');

		if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }
        
        #$query = "INSERT INTO TECHNICIANS (firstName, lastName, email, phone, password) VALUES ('$name', '$lastName', '$email', '$phone', '$password')";
        $stmt = $con->prepare("INSERT INTO TECHNICIANS (firstName, lastName, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $lastName, $email, $phone, $password);

        // test for HTML characters to avoid HTML Injection
        require ("../TestInput.php");
        $name = test_input($name);
        $lastName = test_input($lastName);
        $email = test_input($email);
        $phone = test_input($phone);
        $password = test_input($password);

    	if ($stmt->execute()) { 
		   header('Location: index.php');
		} else {
		   echo "Error adding record: " . mysqli_error($con);
		}
        $stmt->close();
        

	} catch (Exception $e) {
		//header("Refresh:5; url=addTechnician.php");
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