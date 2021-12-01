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
            echo "<form name='form' action='index.php' method='post'>";
            echo "<label for='lastname'>" . "Last Name: ". "</label>";
            echo "<input type='text' name='lastname' id='lastname'>";
            echo "<td> <button type='submit' name='searchCustomer'>Search</button></td>";
        echo "</form></tr>";
             
        echo "<h1>" . "Results" . "</h1>";
        echo "<table>";

        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            if (empty($_POST["lastname"])) {
                $comment = "";
                //$_SESSION["yeah"] = $comment;
                $query = "SELECT customerID, firstName, lastName, email, city FROM customers;";
                $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));
            
            } else {
                $comment = test_input($_POST["lastname"]);
                //$_SESSION["yeah"] = $comment;
                //$search = "true";
                $query = "SELECT customerID, firstName, lastName, email, city FROM customers WHERE lastName = '$comment'; ";
                $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));
            }}
        else {
            $query = "SELECT customerID, firstName, lastName, email, city FROM customers;";
            $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));
        }

        # field result set 
        $finfo = mysqli_fetch_fields($result);
        
        # loop through field names and print as headers 
        echo "<tr>";
        $first = True;
        foreach ($finfo as $val) {
            if(!$first){
                if($val->name == "firstName"){
                    echo "<th>" . "Name" . "</th>";}
                elseif($val->name == "lastName"){
                    }
                elseif($val->name == "email"){
                    echo "<th>" . "Email Address" . "</th>";}
                elseif($val->name == "city"){
                    echo "<th>" . "City" . "</th>";}
                else{
            echo "<th>" . " $val->name" . "</th>";}
            } else $first = False;
        }
        echo "<th></th>"; # empty header for select button
        echo "</tr>";

        # loop over result set. Print field values for each record
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            # start table row
            echo "<tr>";

            $first = True;
            $second = True;
            $third = True;
            # inner loop. Print each field value for a record
            foreach ($line as $field_value) {
                //if()
                if(!$first && !$second && !$third){
                    echo "<td>", "$field_value", "</td>";
                } 
                elseif($second && !$first){
                    $second = False;
                    $fullName = $field_value;
                }
                elseif($third && !$first){
                    $third = False;
                    $fullName .= " " . $field_value;
                    echo "<td>", "$fullName", "</td>";
                }
                else {
                    $first = False;
                    //$_SESSION["customerID"] = $field_value;
                    $idd = $line['customerID'];
                    //echo $idd;
                }
            }

            #select buttons
            echo "<form action='viewupdateCustomer.php' method='post'>";
            echo "<td> <button type='submit' name='selectItem' value='" . $idd . "' />Select</button></td>";
            echo "</form>";

            # end table row and loop
            echo "</tr>";
        }
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