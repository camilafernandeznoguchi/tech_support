<!--Produced by: Juliana Spitzner-->

<?php 
session_start();

require('../view/header.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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
	$id = $_POST["selectItem"];
	$query = "SELECT * FROM customers WHERE customerID = '$id';";
    $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

	$queryCountry = "SELECT * FROM countries;";
	$resultCountry = mysqli_query($con, $queryCountry)or die('Query failed: ' . mysqli_errno($con));

	$arrayCountries = array();
	$count = 3;
	$full = array();
	while ($lineCountry = mysqli_fetch_array($resultCountry, MYSQLI_ASSOC)) {
		foreach ($lineCountry as $field_valueCountry) {
			if ($count % 2 != 0){
				$value = $field_valueCountry;
			}
			else{
				array_push($arrayCountries, $field_valueCountry);
				$full[$value] = $field_valueCountry;
			}
			$count += 1;
		}
	}

	$_SESSION["array"] = $full;

	//print_r($full);

	# field result set
	$finfo = mysqli_fetch_fields($result);

	# loop over result set. Print field values for each record
	while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		$customer_ID = $_POST["selectItem"];
		$first_name = $line["firstName"];
		$last_name = $line["lastName"];
		$address = $line["address"];
		$city = $line["city"];
		$state = $line["state"];
		$postalcode = $line["postalCode"];
		$countrycode = $line["countryCode"];
		$phone = $line["phone"];
		$email = $line["email"];
		$password = $line["password"];
	}
}
catch (Exception $e) {
	//echo "Error: " . $e->getMessage() . "<br>Line" . $e->getLine();
	$error_message = $e->getMessage() . "<br>Line" . $e->getLine();
        echo "<form action='../errors/database_error.php' method='post'>";
        echo "<input type='hidden' name='error' value=\"".$error_message."\" >";
        echo "</form>";
        //echo "Message: " . $e->getMessage() . "<br>Line" . $e->getLine();
        header("Location: ../errors/database_error.php?error=".$error_message);
} finally {
	mysqli_close($con);
}

$_SESSION["customer_id"] = $customer_ID;
?>

<main>
	<h1>View/Update Customer</h1>
	<table>
	<col style="width:25%">
		<tr><td>
		<form action="update_.php" method="post">
			First Name:  </td><td><input type="text" name="first" required="required" min="1" max="50" value=<?php echo "'$first_name'"?>><br>
			</td></tr>
			<tr><td>
			Last Name: </td><td><input type="text" name="last" required="required" min="1" max="50" value=<?php echo "'$last_name'"?>><br>
			</td></tr>
			<tr><td>
			Address:  </td><td><input size="50" type="text" name="address" required="required" min="1" max="50" value=<?php echo "'$address'"?>><br>
			</td></tr>
			<tr><td>
			City:  </td><td><input type="text" name="city" required="required" min="1" max="50" value=<?php echo "'$city'"?>><br>
			</td></tr>
			<tr><td>
			State:  </td><td><input type="text" name="state" required="required" min="1" max="50" value=<?php echo "'$state'"?>><br>
			</td></tr>
			<tr><td>
			Postal Code:  </td><td><input type="text" name="postal" required="required" min="1" max="20" value=<?php echo "'$postalcode'"?>><br>
			</td></tr>
			<?php $code = $full[$countrycode]; ?>
			<tr><td>
			Country Code:  </td><td>
			<?php
			echo "<select name='browser'>";
			foreach ($arrayCountries as $country) {
				echo "<option value='$country'>";
				echo $country;
				echo "</option>";
			}
			echo "<option value='default' selected> $code </option>";
			echo "</select>";
			?>
			<!--
			<input list="browsers" name="browser" id="browser" value=<?php echo "'$code'"?>>
			<datalist id="browsers">
			<?php /*foreach ($arrayCountries as $country) {
					echo "<option value='" . $country . "'>";
					echo $country;
				}*/ ?>
			</datalist>--></td></tr>
			<tr><td>
			Phone:  </td><td><input type="text" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value=<?php echo "'$phone'"?>><br>
			</td></tr>
			<tr><td>
			Email:  </td><td><input size="50" type="email" min="1" max="50" name="email" required="required" value=<?php echo "'$email'"?>><br>
			</td></tr>
			<tr><td>
			Password:  </td><td><input type="text" name="password" min="6" max="20" value=<?php echo "'$password'"?>><br>
			</td></tr>
			<td> </td><td><input type="submit" value="Update Customer"></td>

	
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
	<a href="index.php">Search Customers</a>

</main>


<!-- <form method="post" action="update_.php">
<input type="hidden" name="customer_id" 
 value="<?php echo $customer_ID; ?>">
	</form> -->
<form method="post" action="update_.php">
<input type="hidden" name="array" 
 value="<?php echo $full; ?>">
	</form>

<?php include('../view/footer.php');?>