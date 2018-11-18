<?php 
    include_once('users.php');
    include_once('configcode.php');
    $configs = new configcode("config.php");
    session_start();
    
    if (trim($_POST['login'])=="login")
    {
        //process login form
        $con = $configs->getConfigs();
        //check login attempt is valid
        //TODO: add form validation
        if ($con['edit']==TRUE)
        {
            //Cannot login. Need to set up database

        } else
        {
            //connect to database and check if username exists.
            $mysqli = new mysqli($con['database_url'],$con['database_user'],$con['database_pass'],'challenge-11-18');
            if ($mysqli->connect_errno) {
                    //connection failed
                    echo "MySQL Error - Contact Admin";
                    error_log("Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
            } else
            {
                
                $sql = "SELECT * FROM users WHERE username='".$_POST['username']."'";
                if (!$result = $mysqli->query($sql)) {
                    //SQL Error
                    echo "MySQL Error - Contact Admin";
                    error_log("SQL Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("SQL Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
                }
                else
                {
                    if ($result->num_rows === 0)
                    {
                        //no matching users. we just tell user username or password is wrong.
                    } else
                    {
                        $user = $result->fetch_assoc();
                        if ($user['password']==$_POST['password'])
                        {
                            //we have a winner.
                        } else
                        {
                            // password wrong. we just tell user username or password is wrong.
                        }
                    }
                }
                $result->free();
            }
            $mysqli->close();
        }
        
    }

?>