<!--Produced by: Gabriela Hernandez-->

<?php 

session_set_cookie_params(0);
session_start();

require('../view/header.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


try {
	# Connecting to database
	require('../model/database.php');

	# Checking connection
	if (mysqli_connect_error($con)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
		exit("Connect Error");
	}
	
	# grabbing product that was selected by user
	$productname = $_POST["productslist"];
	$productname = implode(" ",$productname);
	
	$query = "SELECT productCode FROM products WHERE name = '$productname';";
	
    $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));
    $line = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $customerID = $_SESSION['customerID'];
    $prod_code = array_values($line)[0];
    $date = date("Y-m-d h:i:s");
   	$register_query = "INSERT INTO registrations VALUES ('$customerID', '$prod_code', '$date')";
   	if (mysqli_query($con, $register_query)) {
      #echo "Record added successfully";
    }
    else {
      echo "Error adding record: " . mysqli_error($con);
    }
	
}
catch (Exception $e) {
	echo "Error: " . $e->getMessage() . "<br>Line" . $e->getLine();
} finally {
	mysqli_close($con);
}

?>

<main>
	<h1>Register Product</h1>
	
	<table>
	<col style="width:25%">
		<tr><td>
		<form action="register.php" method="post">
			Product: <?php echo "($prod_code)"?> was registered successfully.
			</td></tr>
		</form>
	</table>

	<style>
		table, tr, td {
			border: none;
		}
		td.address {
			width: 500px;
		}
	</style>

	<br>

</main>

<?php include('../view/footer.php');?>