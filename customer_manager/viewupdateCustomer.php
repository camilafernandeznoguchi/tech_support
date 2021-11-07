<?php require('../view/header.php');?>

<style>
	table, tr, td {
	    border: none;
	}
</style>

<main>
	<!--Produced by: Juliana Spitzner-->
	<h1>View/Update Customer</h1>

	<table>
	
	<form action='add.php' method='post'>
	<tr>
		<td><label for='name'>First Name:</label></td>
		<td><input type='text' id='name' name='name'></td>
	</tr>
	<tr>
		<td><label for='lastName'>Last Name:</label></td>
		<td><input type='text' id='lastName' name='lastName'></td>
	</tr>
	<tr>
		<td><label for='address'>Address:</label></td>
		<td><input type='text' id='address' name='address'></td>
	</tr>
	<tr>
		<td><label for='city'>City:</label></td>
		<td><input type='text' id='city' name='city'></td>
	</tr>
	<tr>
		<td><label for='state'>State:</label></td>
		<td><input type='text' id='state' name='state'></td>
	</tr>
	<tr>
		<td><label for='postalcode'>Postal Code:</label></td>
		<td><input type='text' id='postalcode' name='postalcode'></td>
	</tr>
	<tr>
		<td><label for='countrycode'>Country Code:</label></td>
		<td><input type='text' id='countrycode' name='countrycode'></td>
	</tr>
	<tr>
		<td><label for='phone'>Phone:</label></td>
		<td><input type='text' id='phone' name='phone'></td>
	</tr>
	<tr>
		<td><label for='email'>Email:</label></td>
		<td><input type='text' id='email' name='email'></td>
	</tr>
    <tr>
		<td><label for='password'>Password:</label></td>
		<td><input type='text' id='password' name='password'></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Update Customer' name='AddTechnician'/></td>
	</tr>
	</form>

	</table>
    <br>
	<a href="index.php">Search Customers</a>

</main>

<?php include('../view/footer.php');?>