<?php 
    //include all required classes
    include_once("users.php");
    include_once("configcode.php");
    $configs = new configcode("config.php");
    session_start();
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>November Tech Challenge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div>
        <div>
            Register New User : 
        </div>
        <div>
            <form action="/response.php" method="post">
            <fieldset>
                <legend>Login:</legend>
                Username:<br>
                <input type="text" name="username" /> <br>
                Password:<br>
                <input type="password" name="password" /> <br>
                <input type="password" name="passwordConfirm" /> <br>
                <input type="submit" name="login" value="login">
            </fieldset>
            </form>
        </div>
    </div>
</body>
</html>

