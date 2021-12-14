<!--Produced by: Gabriela Hernandez-->

<?php require('../view/header.php');?>

<?php 

// if session already has variables saved, redirect to processform.php page
//session_set_cookie_params(0);
session_start();

if (isset($_SESSION['email'])) { 
    // destroy past session
    session_destroy();
}

// start new session
session_start();


    echo '
    <!DOCTYPE html>
    <html>
    <head>
        
    <style>
    table, tr, td, h1, p {
    border: none;
    margin:20px;
    }
    </style>
        
    </head>
        
    <body>
        
        <h1>Customer Login</h1>
        <p>You must login before you register a product</p>
        <form action="ProcessForm.php" method="post">
        <table>
            <tr><td>Email:</td><td> <input type="text" name="email"></td>
            <tr><td>Password:</td><td> <input type="text" name="password"></td>
            <td colspan="2"><input type="submit" value="Login"></td></tr>
        </table>
        </form>
        <br/>
    </body>
        
    </html>
    ';
    
// used to be just processform.php

?>

<?php include('../view/footer.php');?>