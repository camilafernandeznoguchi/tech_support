<?php require('../view/header.php');?>

<main>
    <!--Produced by: Camila Fernandez Noguchi-->
    <h1>Technician List</h1>

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
        $query = "SELECT * FROM technicians;";
        $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

        # field result set
        $finfo = mysqli_fetch_fields($result);
        # loop through field names and print as headers
        echo "<tr>";
        $first = True;
        foreach ($finfo as $val) {
            if(!$first){
            echo "<th>" . " $val->name" . "</th>";
            } else $first = False;
        }
        echo "<th></th>"; # empty header for delete button
        echo "</tr>";

        # loop over result set. Print field values for each record
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            # start table row
            echo "<tr>";

            $first = True;
            # inner loop. Print each field value for a record
            foreach ($line as $field_value) {
                if(!$first){
                    echo "<td>", "$field_value", "</td>";
                } else $first = False;
            }

            #delete buttons
            echo "<form action='delete.php' method='post'>";
            echo "<td> <button type='submit' name='deleteItem' value='" . $line['techID'] . "' />Delete</button></td>";
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
        header("Location: ../errors/database_error.php?error=".$error_message);
    } finally {
        mysqli_close($con);
    }

	?>
	</table>

    <a href="addTechnician.php">Add Technician</a>

</main>

<?php include('../view/footer.php');?>