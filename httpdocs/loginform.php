<form action="/login.php" method="post">
    <fieldset>
        <legend>Login:</legend>
        Username:<br>
        <input type="text" name="username" /> <br>
        Password:<br>
        <input type="password" name="password" /> <br>
        <input type="submit" name="login" value="Login">
    </fieldset>
</form>
<form action="/register.php" method="post">
        <input type="submit" name="register" value="Register">
    
</form>
<?php
if (isset($_SESSION['username']))
{
    //optional log out button.
?>
<form action="/logout.php" method="post">
        <input type="submit" name="logout" value="Logout">
    
</form>
<?php
}
?>

