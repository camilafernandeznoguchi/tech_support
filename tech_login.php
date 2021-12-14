<?php include 'view/headerIndex.php'; ?>

<style>
    table, tr, td, h1, p {
    border: none;
    }
</style>

<main>
    <nav>
        
    <h2>Technician Login</h2>
    <p>You must login before you can update an incident.</p> 
        <form action="under_construction.php" method="post">
        <table>
            <tr><td>Email:</td><td> <input type="text" name="tech_email"></td>
            <tr><td>Password:</td><td> <input type="text" name="tech_password"></td>
            <td colspan="2"><input type="submit" value="Login"></td></tr>
        </table>
        </form>
    
    </nav>
</section>
<?php include 'view/footer.php'; ?>