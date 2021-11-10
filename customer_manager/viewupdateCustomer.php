<?php 
session_start();

require('../view/header.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


try {
	# Conect to database
	require('../model/database.php');

	# Check connection
	if (mysqli_connect_error($con)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
		exit("Connect Error");
	}
	$id = $_SESSION["customerID"];
	$query = "SELECT * FROM customers WHERE customerID = '$id';";
    $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

	# field result set
	$finfo = mysqli_fetch_fields($result);

	# loop over result set. Print field values for each record
	while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		$customer_ID = $line["customerID"];
		//echo $customer_ID;
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
	echo "Error: " . $e->getMessage() . "<br>Line" . $e->getLine();
} finally {
	mysqli_close($con);
}
?>

<main>

<h1>View/Update Customer</h1>
<table>

<tr><td>
<form action="update_.php" method="post">
First Name: <input type="text" name="first" value=<?php echo "'$first_name'"?>><br>
</td></tr>
<tr><td>
Last Name: <input type="text" name="last" value=<?php echo "'$last_name'"?>><br>
</td></tr>
<tr><td>
Address: <input type="text" name="address" value=<?php echo "'$address'"?>><br>
</td></tr>
<tr><td>
City: <input type="text" name="city" value=<?php echo "'$city'"?>><br>
</td></tr>
<tr><td>
State: <input type="text" name="state" value=<?php echo "'$state'"?>><br>
</td></tr>
<tr><td>
Postal Code: <input type="text" name="postal" value=<?php echo "'$postalcode'"?>><br>
</td></tr>
<tr><td>
Country Code: <input type="text" name="country" value=<?php echo "'$countrycode'"?>><br>
</td></tr>
<tr><td>
Phone: <input type="text" name="phone" value=<?php echo "'$phone'"?>><br>
</td></tr>
<tr><td>
Email: <input type="text" name="email" value=<?php echo "'$email'"?>><br>
</td></tr>
<tr><td>
Password: <input type="text" name="password" value=<?php echo "'$password'"?>><br>
</td></tr>

<td><input type="submit" value="Update Customer"></td>

</table>
</form>

<style>
    table, tr, td {
        border: none;
    }
</style>

<br>
<a href="index.php">Search Customers</a>
</main>

	</table>

</main>

<?php include('../view/footer.php');?>