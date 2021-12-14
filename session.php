<?php
   session_start();
   
   $user_check = $_SESSION['login_user'];

   require('model/database.php');
   if (mysqli_connect_error($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
      exit("Connect Error");
   }
   
   $ses_sql = mysqli_query($con,"select email from technicians where email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:tech_login.php");
      die();
   }
?>