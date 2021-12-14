<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: tech_login.php");
   }
?>