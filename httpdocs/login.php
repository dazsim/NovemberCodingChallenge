<?php 
    include_once('users.php');
    include_once('configcode.php');
    $configs = new configcode("config.php");
    session_start();
    
    if (trim($_POST['login'])=="login")
    {
        //process login form
        $con = $configs->getConfigs();
        if ($con['edit']==TRUE)
        {
            //Cannot login. Need to set up database
        } else
        {
            //connect to database and check if username exists.
        }
        
    }

?>