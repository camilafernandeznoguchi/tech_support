<!--Produced by: Gabriela Hernandez-->

<?php require('../view/header.php');?>

<?php

session_set_cookie_params(0);
session_start();
    

    // allow MySQLi error reporting and Exception handling
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        // Connect to MySQL, select database
        require ("../model/database.php");

        // testing name for HTML characters to avoid HTML Injection
        $name = $_SESSION['email'];
        // debugging: echo $_SESSION['email'];

        // QUERY #1 : First query to verify email exists
        $query = "SELECT firstName, lastName FROM customers WHERE email='$name'";
        $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

        $rows = mysqli_num_rows($result);

        // if userid not in login table, redirect to error page and try again
        if ($rows < 1)
            header("Location: error.php?message='user not found'");
        
        // QUERY #2 : Second query to get product names
        $query2 = "SELECT name FROM products";
        $result2 = mysqli_query($con, $query2) or die('Query failed: ' . mysqli_errno($con));
            
        $rows2 = mysqli_num_rows($result2);
            
        if ($rows2 < 1)
            header("Location: error.php?message='user not found'");

        //Get customerID for registering
        $customerID_query = "SELECT customerID FROM customers WHERE email='$name'";
        $customerID_result = mysqli_query($con, $customerID_query) or die('Query failed: ' . mysqli_errno($con));
        while ($line = mysqli_fetch_array($customerID_result, MYSQLI_ASSOC)) {
            foreach ($line as $field_value) {
                $_SESSION['customerID'] = $field_value;
            }
        }
        

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
        
        echo "You are logged in as ". $_SESSION['email'];
        
        echo "</body></html>";   
        
        echo "<form action='ind2.php' method='post'>";
        echo "<br>";
        echo "<button type='submit'> Logout </button>";
        echo "</form>";
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
    
?>


<?php include('../view/footer.php');?>