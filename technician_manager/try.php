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
    $query = "SELECT name FROM products";
    $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));
    
    echo "<html>";
    echo "<body>";
    
    echo "<form action='#' method='post'>";
    echo "<select name='ProductsList[]'>";
    
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        foreach ($line as $col_value) {
            echo "<option value='$col_value'>";
            echo "$col_value";
            echo "</option>";
        }
    }
    
    echo "</select>";
    echo "<input type='submit' name='submit' value='Submit' />";
    echo "</form>";
    
    echo "</body>";
    echo "</html>";
  }
  catch(Exception $e){
    echo "Error: " . $e->getMessage() . "<br>Line " . $e->getLine();
  } finally{
    mysqli_close($con);
  }

?>

<?php
  if(isset($_POST['submit'])) {

     foreach ($_POST['ProductsList'] as $select)
     {
       echo $select;
     }
   }
?>