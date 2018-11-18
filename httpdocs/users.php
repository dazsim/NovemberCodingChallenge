<?php

class User {
    /** 
     * This Class contains all the helper functions for each user, getters and setters and database query generation.
    */
    
    private $username;
    private $password;
    private $email;
    private $id;

    

    

    /**
     * Constructor for User
     */    
    public function User($id,$username,$password,$email)
    {
        $this->$id = $id;
        $this->$username = $username;
        $this->$password = $password;
        $this->$email = $email;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * This function returns wether the email for this object is valid or not
     */
    public function isValidEmail()
    {
        return filter_var($this->$email,FILTER_VALIDATE_EMAIL);
    }


    /**
     * Here we decide what is and is not a valid username
     */
    public function isValidUsername()
    {

    }

    /**
     * Here we decide on what is and isn't a valid Password.
     */
    public function isValidPassword()
    {

    }
}