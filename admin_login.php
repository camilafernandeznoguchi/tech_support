<?php include 'view/headerIndex.php'; ?>

<?php
  ob_start();
  session_start();

  error_reporting(0);
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  try{

    //grabs input and saves into variable
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['admin_username'];
        $password = $_POST['admin_password'];

        //connect to db
        require('model/database.php');
        if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }

        // test for HTML characters to avoid HTML Injection
        require ("TestInput.php");
        $username = test_input($username);
        $password = test_input($password);

        //prepare SQL query to validate email
        $query = mysqli_prepare($con, "SELECT * FROM administrators WHERE username=? AND password =?");
        mysqli_stmt_bind_param($query, "ss", $username, $password);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        // if more than 1 person with same email, redirect to error page and try again
        $rows = mysqli_num_rows($result);

        if($rows == 1) {
          #session_register("email");
          $_SESSION['login_user'] = $username;
          header("location: selectIncident.php");
        }else {
          $error = "Your Login Name or Password is invalid";
        }
    }


  } catch (Exception $e) {
    $error_message = $e->getMessage() . "<br>Line" . $e->getLine();
    echo "<form action='../errors/database_error.php' method='post'>";
    echo "<input type='hidden' name='error' value=\"".$error_message."\" >";
    echo "</form>";
    header("Location: ../errors/database_error.php?error=".$error_message);
  } finally {
    // close connection
    mysqli_close($con);
  }

?>


<style>
    table, tr, td, h1, p {
    border: none;
    }
</style>

<main>
    <nav>
        
    <h2>Admin Login</h2>
        <form action="" method="post">
        <table>
            <tr><td>Username:</td><td> <input type="text" name="admin_username"></td>
            <tr><td>Password:</td><td> <input type="text" name="admin_password"></td>
            <td colspan="2"><input type="submit" value="Login"></td></tr>
            <tr><?php echo $error; ?></tr>
        </table>
        </form>
    
    </nav>
</main>

<?php include 'view/footer.php'; ?>
