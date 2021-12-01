<?php include '../view/header.php'; ?>
<main>
<nav>
    <h1>Database Error</h1>
    <p>There was an error connecting to the database.</p>
   
    <p>Error message: <?php $error_messsage = $_GET['error'];
    echo $error_messsage; ?></p>
    </nav>
</main>
<?php include '../view/footer.php'; ?>