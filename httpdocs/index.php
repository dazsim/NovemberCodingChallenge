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
            Welcome to My Generic Login System. 
            <?php 
                if (isset($_SESSION['user']))
                    echo $_SESSION['user'];
            ?> 
        </div>
        <div>
            <?php include("loginform.php"); ?>
        </div>
</div>
</body>
</html>