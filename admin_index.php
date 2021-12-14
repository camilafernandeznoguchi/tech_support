<?php include 'view/headerIndex.php'; ?>

<main>
    <nav>
        
    <h2>Admin Menu</h2>
    <ul>
        <li><a href="product_manager">Manage Products</a></li>
        <li><a href="technician_manager">Manage Technicians</a></li>
        <li><a href="customer_manager">Manage Customers</a></li>
        <li><a href="create_incident">Create Incident</a></li>
        <li><a href="under_construction.php">Assign Incident</a></li>
        <li><a href="under_construction.php">Display Incidents</a></li>
    </ul>

    <h2>Login Status</h2>
    <p>Your are logged in as admin</p>

    <form action="index.php" onsubmit="return confirm('Do you really want to logout?');" method="post">
    <input type="submit" value=Logout>
    </form >
    
    </nav>
</main>
<?php include 'view/footer.php'; ?>
