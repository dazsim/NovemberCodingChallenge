<?php 
    include_once('users.php');
    include_once('configcode.php');
    $configs = new configcode("config.php");
    session_start();
    $_POST['login'] = test_input($_POST['login']);
    if (trim($_POST['login'])=="Login")
    {
        $_POST['username'] = test_input($_POST['username']);
        $_POST['password'] = test_input($_POST['password']);
        

        //process login form
        $con = $configs->getConfigs();
        //check login attempt is valid
        //TODO: add form validation
        if (isset($con['edit']))
        {
            //Cannot login. Need to set up database
            $sorry = "Please set up your configuration File before using website";
            header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
            exit();
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
                    exit();
            } else
            {
                
                //$sql = "SELECT * FROM users WHERE username='".$_POST['username']."'";
                //Change this to a prepared statement
                $sql = "SELECT * FROM users WHERE username=?";
                $prep = $mysqli->prepare($sql);
                $prep->bind_param("s",$_POST['username']);
                if (!$result = $prep->execute()) {
                    //SQL Error
                    error_log("SQL Error : ".$mysqli->connect_errno, 3, "../challenge_error.log");
                    error_log("SQL Error : ".$mysqli->connect_error, 3, "../challenge_error.log");
                    $sorry = "SQL error - Contact Admin";
                    header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
                    exit();
                }
                else
                {
                    if ($result->num_rows === 0)
                    {
                        //no matching users. we just tell user username or password is wrong.
                        $sorry = "Sorry, your username or password was incorrect";
                        header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
                        exit();
                    } else
                    {
                        $result = $prep->get_result();
                        $user = $result->fetch_assoc();
                        if (password_verify ( $_POST['password'] , $user['password'] ))
                        {
                            //we have a winner.
                            //build session then redirect to index.
                            $_SESSION['username'] = $_POST['username'];//we do not store password or email in the session.
                            $_SESSION['loggedin'] = 1;
                            $sorry = "Congratulations. You are Logged In.";
                            header('Location: index.php?messagetype=success&message='.urlencode($sorry)); 
                            exit();
                        } else
                        {
                            // password wrong. we just tell user username or password is wrong.
                            $sorry = "Sorry, your username or password was incorrect";
                            header('Location: index.php?messagetype=error&message='.urlencode($sorry)); 
                            exit();
                        }
                    }
                }
                $result->free();
            }
            $mysqli->close();
        }
        
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>