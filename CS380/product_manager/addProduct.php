<?php require('../view/header.php');?>

<style>
	table, tr, td {
	    border: none;
	}
</style>

<main>
	<!--Produced by: Camila Fernandez Noguchi-->
	<h1>Add Product</h1>

	<table>
	
	<form action='add.php' method='post'>
	<tr>
		<td><label for='code'>Code:</label></td>
		<td><input type='text' id='code' name='code'></td>
	</tr>
	<tr>
		<td><label for='name'>Name:</label></td>
		<td><input type='text' id='name' name='name'></td>
	</tr>
	<tr>
		<td><label for='version'>Version:</label></td>
		<td><input type='text' id='version' name='version'></td>
	</tr>
	<tr>
		<td><label for='release'>Release Date:</label></td>
		<td><input type='text' id='release' name='release'></td>
		<td><label>Use 'yyyy-mm-dd' format</label></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Add Product' name='AddProduct'/></td>
	</tr>
	</form>

	</table>

	<a href="index.php">View Product List</a>

</main>

<?php include('../view/footer.php');?>