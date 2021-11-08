<?php 
session_start();
require('../view/header.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$var = $_SESSION["yeah"];
//echo $var;

try {
	# Conect to database
	require('../model/database.php');

	# Check connection
	if (mysqli_connect_error($con)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
		exit("Connect Error");
	}
	$id = $_SESSION["iddd"];
	//$id = "SELECT customerID FROM customers WHERE lastName = '$var';";

	//$query = "SELECT * FROM customers WHERE lastName = '$var';";
	$query = "SELECT * FROM customers WHERE customerID = '$id';";
    $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

	# field result set
	$finfo = mysqli_fetch_fields($result);

	# loop over result set. Print field values for each record
	while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		//print_r($line);
		//echo $line["firstName"];
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
		# start table row
		echo "<tr>";

		$first = True;
		# inner loop. Print each field value for a record
		foreach ($line as $field_value) {
			if(!$first){
				//echo "<td>", "$field_value", "</td>";
			} else $first = False;
		}
		echo "</tr>";
	}
}
catch (Exception $e) {
	echo "Error: " . $e->getMessage() . "<br>Line" . $e->getLine();
} finally {
	mysqli_close($con);
}

echo "<main>";
echo "<h1>". "View/Update Customer"."</h1>";

echo "<table>";
	
echo "<form action='add.php' method='post'>";
	echo "<tr>";
		echo "<td>" . "<label for='name'>" . "First Name:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='name' name='name' value= $first_name>" . "</td>";
	echo "</tr>";


	echo "<tr>";
		echo "<td>" . "<label for='lastName'>" . "Last Name:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='lastName' name='lastName' value= $last_name>" . "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>" . "<label for='address'>" . "Address:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='address' name='address' value= $address>" . "</td>";
	echo "</tr>";

	
	echo "<tr>";
		echo "<td>" . "<label for='city'>" . "City:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='city' name='city' value= $city>" . "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>" . "<label for='state'>" . "State:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='state' name='state' value= $state>" . "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>" . "<label for='postalcode'>" . "Postal Code:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='postalcode' name='postalcode' value= $postalcode>" . "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>" . "<label for='countrycode'>" . "Country Code:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='countrycode' name='countrycode' value= $countrycode>" . "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>" . "<label for='phone'>" . "Phone:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='phone' name='phone' value= $phone>" . "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>" . "<label for='email'>" . "Email:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='email' name='email' value= $email>" . "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>" . "<label for='password'>" . "Password:" . "</label>" ."</td>";
		echo "<td>" . "<input type='text' id='password' name='password' value= $password>" . "</td>";
	echo "</tr>";

?>

<style>
	table, tr, td {
	    border: none;
	}
</style>

<main>
	<!--Produced by: Juliana Spitzner-->	

	<tr>
		<td></td>
		<td><input type='submit' value='Update Customer' name='updateCustomer'/></td>

	<?php 		

	test_input($_POST["password"]);

	if ($_SERVER["REQUEST_METHOD"] == "POST") { 
			if (empty($_POST["address"])) {
				echo $_POST["address"];
			echo "hi";}
			else {
				echo $_POST["address"];
				$updated_first = test_input($_POST["address"]);
				echo $updated_first;
			}
		}

		
	?>

	</tr>
	</form>

	</table>
    <br>
	<a href="index.php">Search Customers</a>

</main>

<?php include('../view/footer.php');?>