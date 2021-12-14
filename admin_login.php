<?php include 'view/headerIndex.php'; ?>

<style>
    table, tr, td, h1, p {
    border: none;
    }
</style>

<main>
    <nav>
        
    <h2>Admin Login</h2>
        <form action="admin_index.php" method="post">
        <table>
            <tr><td>Username:</td><td> <input type="text" name="username"></td>
            <tr><td>Password:</td><td> <input type="text" name="password"></td>
            <td colspan="2"><input type="submit" value="Login"></td></tr>
        </table>
        </form>
    
    </nav>
</section>
<?php include 'view/footer.php'; ?>