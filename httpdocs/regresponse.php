<?php 
    include_once('users.php');//not yet used. not needed at this point. maybe later when more complex.
    include_once('configcode.php');
    $configs = new configcode("config.php");
    session_start();
    
    if (trim($_POST['register'])=="Register")
    {
        //process register form
        $con = $configs->getConfigs();
        //check register attempt is valid
        if (!($_POST['password'] == $_POST['passwordConfirm']))
        {
            //error. redirect
            $sorry = "Passwords need to match. Move this to javascript";
            header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
        } 
        
        //validate email
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"; 
            header('Location: register.php?messagetype=error&message='.urlencode($emailErr)); 
        }
        //validate password
        if (strlen($_POST['password'])<6)
        {
            $pass = "Password too short";
            header('Location: register.php?messagetype=error&message='.urlencode($pass)); 
        }
        //validate username
        if(preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
            $unameSorry = "Username format error";
            header('Location: register.php?messagetype=error&message='.urlencode($unameSorry)); 
        }
        if (isset($con['edit']))
        {
            //Cannot login. Need to set up database
            $sorry = "Please set up your configuration File before using website";
            header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
        } else
        {
            //connect to database and attempt to add user.
            
            $mysqli = new mysqli($con['database_url'],$con['database_user'],$con['database_pass'],$con['database_name']);
            if ($mysqli->connect_errno) {
                    //connection failed
                    
                    error_log("Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
                    $sorry = "Connection error - Contact Admin";
                    header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
            } else
            {
                //first check username doesn't already exist.

                $sql = "SELECT * FROM users WHERE username='".$_POST['username']."'";
                if (!$result = $mysqli->query($sql)) {
                    //SQL Error
                    error_log("SQL Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("SQL Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
                    $sorry = "SQL error - Contact Admin ".$sql;
                    header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
                } else
                {
                    if (!$result->num_rows === 0)
                    {
                        $sorry = "That username already exists";
                        header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
                    }
                    $result->free(); //free up result ready for next query
                }
                $sql = "INSERT INTO users (email,username,password) VALUES (\"".$_POST['email']."\",\"".$_POST['username']."\",\"".$_POST['password']."\")";
                if (!$result = $mysqli->query($sql)) {
                    //SQL Error
                    error_log("SQL Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("SQL Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
                    $sorry = "SQL error - Contact Admin ".$sql;
                    header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
                }
                else
                {
                    $result->free();    
                    $mysqli->close();
                    $sorry = "Congratulations, you have created your account";
                    header('Location: index.php?messagetype=success&message='.urlencode($sorry)); 
                    
                }
                
            }
            
        }
        
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>