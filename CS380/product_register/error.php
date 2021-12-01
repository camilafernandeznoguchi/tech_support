<!--  This is an error handling page. $message value sent from another script -->

<?php require('../view/header.php');?>

<html>
<body>
<h3>Error</h3>

<?php 
$message ="";

  if (!empty($_GET['message'])) $message=$_GET['message'];

    echo $message."<br><br>";
    
?>
<a href="index.php">Try again</a>

</body></html>


<?php include('../view/footer.php');?>
