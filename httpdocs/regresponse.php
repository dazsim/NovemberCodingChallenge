<?php 
    include_once('users.php');//not yet used. not needed at this point. maybe later when more complex.
    include_once('configcode.php');
    $configs = new configcode("config.php");
    session_start();
    
    if (trim($_POST['register'])=="Register")
    {
        $_POST['username'] = test_input($_POST['username']);
        $_POST['password'] = test_input($_POST['password']);
        $_POST['passwordConfirm'] = test_input($_POST['passwordConfirm']);
        $_POST['email'] = test_input($_POST['email']);
        //process register form
        $con = $configs->getConfigs();
        //check register attempt is valid
        //check both passwords match
        if (!(test_input($_POST['password']) == test_input($_POST['passwordConfirm'])))
        { 
           
            //error. redirect

            $sorry = "Passwords need to match. Move this to javascript";
            header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
            echo "header failure";
            exit();
        } 
        
        //validate email
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";  
            header('Location: register.php?messagetype=error&message='.urlencode($emailErr)); 
            echo "email : ".$email;
            exit();
            }
        //validate password
        
        if (strlen(test_input($_POST['password']))<=5)
        {
            $pass = "Password too short";
            header('Location: register.php?messagetype=error&message='.urlencode($pass)); 
            exit();
        }
        //validate username
        if(!(preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['username']))) {
            $unameSorry = "Username format error";
            header('Location: register.php?messagetype=error&message='.urlencode($unameSorry)); 
            exit();
        }
        if (isset($con['edit']))
        {
            //Cannot login. Need to set up database
            $sorry = "Please set up your configuration File before using website";
            header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
            exit();
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
                    exit();
            } else
            {
                //first check username doesn't already exist.

                $sql = "SELECT * FROM users WHERE username='".$_POST['username']."' AND email='".$_POST['email']."'";
                if (!$result = $mysqli->query($sql)) {
                    //SQL Error
                    error_log("SQL Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("SQL Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
                    $sorry = "SQL error - Contact Admin ".$sql;
                    header('Location: register.php?messagetype=error&message='.urlencode($sorry)); 
                    exit();
                } else
                {
                    if (!$result->num_rows === 0)
                    {
                        $sorry = "That username already exists";
                        header('Location: register.php?messagetype=error&message='.urlencode($sorry));
                        exit(); 
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
                    exit();
                }
                else
                {
                    //$result->free();    
                    //$mysqli->close();
                    $sorry = "Congratulations, you have created your account";
                    header('Location: index.php?messagetype=success&message='.urlencode($sorry)); 
                    exit();
                    
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