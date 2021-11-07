<?php
  //Produced by: Juliana Spitzner

  // allow MySQLi error reporting and Exception handling
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  error_reporting(0);

  try{
    require('../model/database.php');

    if (mysqli_connect_error($con)) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
          exit("Connect Error");
      }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST['lastname'];
        $query = "SELECT email FROM CUSTOMERS ";
        echo $query;

        if (mysqli_query($con, $query)) {
          echo "Record selected successfully";
          header('Location: index.php');
        }
        else {
          echo "Error selecting record: " . mysqli_error($con);
        }
    }
  }
  catch(Exception $e){
    echo "Error: " . $e->getMessage() . "<br>Line " . $e->getLine();
  } finally{
    mysqli_close($con);
  }

?>