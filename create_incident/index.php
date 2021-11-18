<!--Produced by: Camila Fernandez Noguchi-->
<?php require('../view/header.php');?>

<main>
    <h1>Get Customer</h1>
    <p>You must enter the customer's email address to select the customer.</p>
    <form action="createIncident.php" method="post">
        <label>Email: </label>
        <input type="text" name="email">
        <input type="submit" name="submit" value="Get Customer">
    </form>
</main>

<?php include('../view/footer.php');?>