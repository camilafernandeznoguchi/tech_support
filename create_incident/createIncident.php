<!--Produced by: Camila Fernandez Noguchi-->

<!--Validate email & grab products-->
<?php
error_reporting(0);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    //check if form is filled in
    if (empty($_POST['email'])) throw new Exception("form fields not filled in");

    //grabs input and saves into variable
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
    }

    //connect to db
    require('../model/database.php');
    if (mysqli_connect_error($con)) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
        exit("Connect Error");
    }

    //prepare SQL query to validate email
    $email_query = mysqli_prepare($con, "SELECT firstName, lastName, customerID FROM customers WHERE email = ?");
    mysqli_stmt_bind_param($email_query, "s", $email);
    mysqli_stmt_execute($email_query);
    $email_result = mysqli_stmt_get_result($email_query);

    // if more than 1 person with same email, redirect to error page and try again
    $rows = mysqli_num_rows($email_result);
    if ($rows < 1)
        header("Location: ../errors/database_error.php?error=Email not found");

    //concatenate row to get full name
    $row = mysqli_fetch_array($email_result, MYSQLI_NUM);
    $firstName = $row[0];
    $lastName = $row[1];
    $fullName = $firstName . ' ' . $lastName;
    $customerID = $row[2];
    global $fullName;
    global $customerID;

    //prepare SQL query to grab products that customer has registred
    $product_query = mysqli_prepare($con, "SELECT DISTINCT registrations.productCode, name FROM registrations JOIN products ON registrations.productCode = products.productCode WHERE customerID=?");
    mysqli_stmt_bind_param($product_query, "i", $customerID);
    mysqli_stmt_execute($product_query);
    $product_result = mysqli_stmt_get_result($product_query);

    //add productcode and name to an associative array
    while ($line = mysqli_fetch_array($product_result, MYSQLI_NUM)) {
        $products[$line[0]] = $line[1];
    }
    global $products;

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

<!--Page View-->
<?php require('../view/header.php');?>

<style>
	table, tr, td {
	    border: none;
	}
</style>

<main>
    <h1>Create Incident</h1>

    <table>
    <form action="createIncident2.php" method="post">
        <tr>
            <td>Customer:</td> 
            <td><?php echo $fullName ?></td>
            <input type="hidden" name="custId" value=<?php echo $customerID ?>>
        </tr>
        <tr>
            <td><label>Product:</label></td>
            <td>
                <select name='productCode'>
                    <?php
                    foreach($products as $productcode => $productValue) {
                        echo "<option value='$productcode'>";   
                        echo "$productValue";
                        echo "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Title:</label></td>
            <td><input type="text" name="title"></td>
        </tr>
        <tr>
            <td><label>Description:</label></td>
            <td><textarea name="description" rows="6" cols="40"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Create Incident"></td>
        </tr>
    </form>
    </table>
</main>

<?php include('../view/footer.php');?>