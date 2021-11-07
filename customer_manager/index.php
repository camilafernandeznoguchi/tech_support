<?php require('../view/header.php');?>

<main>
    <!--Produced by: Juliana Spitnzer-->
    <h1>Customer Search</h1>

    <h1>Results</h1>

    <tr><td class="rt">Last Name:</td>
         <td><form name="form" action="" method="get"><input type="text" name="lastname" id="lastname"> 
         </form></tr>
          <?php $input = "Smith"; ?>

    <table>
	<?php
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

        # Perform SQL query
        $query = "SELECT customerID, firstName, lastName, email, city FROM customers WHERE lastName = '$input';";
        $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

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
                    echo "<th>" . " " . "</th>";}
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
            # inner loop. Print each field value for a record
            foreach ($line as $field_value) {
                echo $field_value;
                if(!$first){
                    echo "<td>", "$field_value", "</td>";
                } else $first = False;
            }

            #select buttons
            echo "<form action='select.php' method='post'>";
            echo "<td> <button type='submit' name='selectItem' value='" . $line['customerID'] . "' />Select</button></td>";
            echo "</form>";

            # end table row and loop
            echo "</tr>";
        }
    }
    catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>Line" . $e->getLine();
    } finally {
        mysqli_close($con);
    }

	?>
	</table>
    <a href="viewupdateCustomer.php">View/Update Cusomter</a>



</main>

<?php include('../view/footer.php');?>