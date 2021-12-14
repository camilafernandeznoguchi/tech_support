<!--Produced by: Juliana Spitzner-->

<?php 
session_start();

require('../view/header.php');


//$name = $email = $gender = $comment = $comment = "";
$comment = "";
//global $comment;
//$search = 'false';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<main>
    <?php 
    echo "<h1>" . "Customer Search" . "</h1>";

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


        echo "<tr>";
            echo "<td>";
            echo "<form name='form' action='search.php' method='post'>";
            echo "<label for='lastname'>" . "Last Name: ". "</label>";
            echo "<input type='text' name='lastname' id='lastname'>";
            echo "<td> <button type='submit' name='searchCustomer'>Search</button></td>";
        echo "</form></tr>";
             
        //Add customer --Juliana Spitzner--
        echo "<h1>" . "Add a new customer" . "</h1>";

        echo "<form action='viewupdateCustomer.php' method='post'>";
            echo "<td> <button type='submit' name='selectItem' value='" . $idd . "' />Add Customer</button></td>";
            echo "</form>";
        
    }
    catch (Exception $e) {
        $error_message = $e->getMessage() . "<br>Line" . $e->getLine();
        echo "<form action='../errors/database_error.php' method='post'>";
        echo "<input type='hidden' name='error' value=\"".$error_message."\" >";
        echo "</form>";
        //echo "Message: " . $e->getMessage() . "<br>Line" . $e->getLine();
        header("Location: ../errors/database_error.php?error=".$error_message);
    } finally {
        mysqli_close($con);
    }
	?>
	</table>

</main>

<?php include('../view/footer.php');?>