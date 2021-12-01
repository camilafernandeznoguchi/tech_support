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
        $query = "DELETE FROM TECHNICIANS WHERE TECHID = '$id'";

        if (mysqli_query($con, $query)) {
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