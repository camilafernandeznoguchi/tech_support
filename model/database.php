<?php
    $host = 'frodo.bentley.edu';
    $dbname= 'tech_support';
    $username = 'cs380';
    $password = 'cs380';
    
    // allow MySQLi error reporting and Exception handling
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
    	// Connect to MySQL, select database
    	$con = mysqli_connect($host,$username,$password, $dbname);
       
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>