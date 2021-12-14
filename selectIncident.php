<?php include 'view/headerIndex.php'; ?>
<?php include('session.php'); ?>

<style>
	table {
		font-size: 14px;
	}
</style>

<main>
    <nav>
        
    <h2>Select Incident</h2>
    <p>You are logged in as <?php echo $login_session; ?></p>

	<form action="logout.php" onsubmit="return confirm('Do you really want to logout?');" method="post">
    <input type="submit" value=Logout>
    </form >

	<br>
    
    </nav>

<?php
	
	error_reporting(0);
  	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	try{
		//connect to db
        require('model/database.php');
        if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }

        //prepare SQL query to get techID
        $query = mysqli_prepare($con, "SELECT techID FROM technicians WHERE email=?");
        mysqli_stmt_bind_param($query, "s", $login_session);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $techID = $row[0];

        //prepare SQL query to get incidents from techID
        $query2 = mysqli_prepare($con, "SELECT * FROM incidents WHERE techID=? AND dateClosed IS NULL");
        mysqli_stmt_bind_param($query2, "s", $techID);
        mysqli_stmt_execute($query2);
        $result2 = mysqli_stmt_get_result($query2);

        $rows = mysqli_num_rows($result2);

        if($rows > 0){ //if the technician has incididents
        	$finfo = mysqli_fetch_fields($result2);
	        echo "<table>";
	        echo "<tr>";
	        foreach ($finfo as $val) {
	        echo "<th>" . " $val->name" . "</th>";
	        }
	        echo "</tr>";

	        # loop over result set. Print field values for each record
	        while ($line = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
	            # start table row
	            echo "<tr>";

	            # inner loop. Print each field value for a record
	            foreach ($line as $field_value) {
	                echo "<td>", "$field_value", "</td>";
	            }

	            # end table row and loop
	            echo "</tr>";
	        }

	        echo "</table>";
        } else{
        	echo "<p>There are no open incidents for this technician</p>";
        	echo "<a href='selectIncident.php'>Refresh List of Incident</a>";
        }

        echo "</main>";


	} catch (Exception $e) {
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

<?php include 'view/footer.php'; ?>