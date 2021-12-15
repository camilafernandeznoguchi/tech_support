<?php
  //Produced by: Camila Fernandez Noguchi

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
        $id = $_POST['deleteItem'];

        // test for HTML characters to avoid HTML Injection
        require ("../TestInput.php");
        $id = test_input($id);

        $query = "DELETE FROM TECHNICIANS WHERE TECHID = '$id'";
        $query = mysqli_prepare($con, "DELETE FROM TECHNICIANS WHERE TECHID = ?");
        mysqli_stmt_bind_param($query, "i", $id);

        if (mysqli_stmt_execute($query)) {
          #echo "Record deleted successfully";
          header('Location: index.php');
        }
        else {
          echo "Error deleting record: " . mysqli_error($con);
        }
    }
  }
  catch(Exception $e){
    $error_message = $e->getMessage() . "<br>Line" . $e->getLine();
        echo "<form action='../errors/database_error.php' method='post'>";
        echo "<input type='hidden' name='error' value=\"".$error_message."\" >";
        echo "</form>";
        header("Location: ../errors/database_error.php?error=".$error_message);
  } finally{
    mysqli_close($con);
  }

?>