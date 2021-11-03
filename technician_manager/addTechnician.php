<?php require('../view/header.php');?>

<style>
	table, tr, td {
	    border: none;
	}
</style>

<main>
	<!--Produced by: Camila Fernandez Noguchi-->
	<h1>Add Technician</h1>

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
		<td><label for='email'>Email:</label></td>
		<td><input type='text' id='email' name='email'></td>
	</tr>
	<tr>
		<td><label for='phone'>Phone:</label></td>
		<td><input type='text' id='phone' name='phone'></td>
	</tr>
    <tr>
		<td><label for='password'>Password:</label></td>
		<td><input type='text' id='password' name='password'></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Add Technician' name='AddTechnician'/></td>
	</tr>
	</form>

	</table>
    <br>
	<a href="index.php">View Technician List</a>

</main>

<?php include('../view/footer.php');?>