<?php 
    include_once('users.php');
    include_once('configcode.php');
    $configs = new configcode("config.php");
    session_start();
    
    if (trim($_POST['login'])=="Login")
    {
        //process login form
        $con = $configs->getConfigs();
        //check login attempt is valid
        //TODO: add form validation
        if (isset($con['edit']))
        {
            //Cannot login. Need to set up database
            $sorry = "Please set up your configuration File before using website";
            header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
        } else
        {
            //connect to database and check if username exists.
            $mysqli = new mysqli($con['database_url'],$con['database_user'],$con['database_pass'],$con['database_name']);
            if ($mysqli->connect_errno) {
                    //connection failed
                    
                    error_log("Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
                    $sorry = "Connection error - Contact Admin";
                    header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
            } else
            {
                
                $sql = "SELECT * FROM users WHERE username='".$_POST['username']."'";
                if (!$result = $mysqli->query($sql)) {
                    //SQL Error
                    error_log("SQL Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("SQL Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
                    $sorry = "SQL error - Contact Admin";
                    header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
                }
                else
                {
                    if ($result->num_rows === 0)
                    {
                        //no matching users. we just tell user username or password is wrong.
                        $sorry = "Sorry, your username or password was incorrect";
                        header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
                    } else
                    {
                        $user = $result->fetch_assoc();
                        if ($user['password']==$_POST['password'])
                        {
                            //we have a winner.
                            //build session then redirect to index.
                        } else
                        {
                            // password wrong. we just tell user username or password is wrong.
                            $sorry = "Sorry, your username or password was incorrect";
                            header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
                        }
                    }
                }
                $result->free();
            }
            $mysqli->close();
        }
        
    }

?>