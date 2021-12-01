<!--Produced by: Camila Fernandez Noguchi-->
<?php require('../view/header.php');?>

<main>
    <h1>Create Incident</h1>
    <?php
    $customerID = $_POST["custId"];
    $productCode = $_POST["productCode"];
    $dateOpened = date("Y-m-d h:i:s");
    $title = $_POST["title"];
    $description = $_POST["description"];

    try{
        //check if form is filled in
        if (empty($_POST['custId']) or empty($_POST['productCode']) or empty($_POST['title']) or empty($_POST['description'])) throw new Exception("form fields not filled in");

        //connect to db
        require('../model/database.php');
        if (mysqli_connect_error($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
            exit("Connect Error");
        }

        $stmt = $con->prepare("INSERT INTO incidents (customerID, productCode, dateOpened, title, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $customerID, $productCode, $dateOpened, $title, $description);
        $stmt->execute();
        echo "The incident was added to our database.";
        $stmt->close();


    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage() . "<br>Line " . $e->getLine();
        header("Location: ../errors/error.php?message=$message");
    }finally {
        // close connection
        mysqli_close($con);
    }
    ?>
</main>

<?php include('../view/footer.php');?>