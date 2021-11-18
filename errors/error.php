<?php include '../view/header.php'; ?>
<main>
<nav>
    <h1>Error</h1>
    <p><?php 
        if(!empty($_GET['message'])) $message=$_GET['message'];
        echo $message; 
    ?></p>
     </nav>
</main>
<?php include '../view/footer.php'; ?>