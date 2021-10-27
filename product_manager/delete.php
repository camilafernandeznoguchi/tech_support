<?php
  //Produced by: Camila Fernandez Noguchi

  // allow MySQLi error reporting and Exception handling
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  try{
    $con = mysqli_connect("webdev.bentley.edu", "fernandcami", "2303", "fernandcami");

    if (mysqli_connect_error($con)) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
          exit("Connect Error");
      }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['deleteItem'];
        $query = "DELETE FROM PRODUCTS WHERE PRODUCTCODE = '$id'";

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
    echo "Error: " . $e->getMessage() . "<br>Line " . $e->getLine();
  } finally{
    mysqli_close($con);
  }

?>