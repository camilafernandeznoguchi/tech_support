<!--Produced by: Gabriela Hernandez-->

<?php require('../view/header.php');?>

<?php

// get values sent from browser and test that both are filled in.
// If not, redirect to error.php
if (! empty($_POST['name']) ) {
    
    $name = $_POST['name']; 
    
    // Turn off default error reporting
   // error_reporting(0);

    // allow MySQLi error reporting and Exception handling
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        // Connect to MySQL, select database
        require ("../model/database.php");

        // testing name for HTML characters to avoid HTML Injection
        require ("TestInput.php");
        $name = test_input($name);

        // QUERY #1 : Perform SQL query
        $query = "SELECT firstName, lastName FROM customers WHERE email='$name'";
        $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

        $rows = mysqli_num_rows($result);

        // if userid not in login table, redirect to error page and try again
        if ($rows < 1)
            header("Location: error.php?message='user not found'");
        
        // Second query to get product names
        $query2 = "SELECT name FROM products";
        $result2 = mysqli_query($con, $query2) or die('Query failed: ' . mysqli_errno($con));
            
        $rows2 = mysqli_num_rows($result2);
            
        if ($rows2 < 1)
            header("Location: error.php?message='user not found'");
        

            // create web page with table and styles  table, tr, td, h1, p 
        echo "<html>
        <head>
        <style>
        .class1 {
        border: none;
        margin:20px;
        width: 300px;
        }
        button {
        margin:20px;
        }
        </style>
        </head>
        <body>
        <h1 class='class1'>Register Product</h1>

        <table class='class1'>";
        
        // Row 1: Customer name
        
        echo "<tr class='class1'>";

        // loop over result set. Print a table row for each record
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<td class='class1'>"."Customer:"."  "."</td>";
            
            // inner loop. Print each table field value for a record
            echo "<td class='class1'>";
            foreach ($line as $col_value) {
                echo "$col_value". " ";
            }
            echo "</td>";
            echo "</tr>";
        }
        
        # Row 2: available products
        
        echo "<tr class='class1'>";
        
        echo "<td style='border:none;';>"."Product:"."  "."</td>"; 
                    
        echo "<td class='class1'>";
        
        echo "<form action='NewProd.php' method='post'>"; 
        echo "<select name='productslist[]'>";
        
            while ($line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {      
                foreach ($line2 as $col_value) {
                    echo "<option value='$col_value'>";   
                    echo "$col_value";
                    echo "</option>";
                }
            }
            
            echo "<option value='default' selected> Default </option>";
            
        echo "</select>";
        echo "<td>";
        
        echo "<input type='submit' name='submit' value='Submit' />";
        echo "</td>";
        echo "</form>";
        
        echo "</td>";
        echo "</tr>";
        
        echo "</table>";
        echo "</body></html>";
        
    } 
    
    catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message");
    } 
    
    finally{
        // close connection
        mysqli_close($con);
    }
} 
else{
    
    if(isset($_POST['submit'])) {
        
        foreach ($_POST['productslist'] as $select)
        {
            echo $select;
        }
    }
    #header("Location: error.php?message='form fields not filled in'");
}
?>


<?php include('../view/footer.php');?>