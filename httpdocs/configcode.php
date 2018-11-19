<?php
include_once("helpers.php");
class ConfigCode {
    public $configFile = "";
    public $configuration = [];

    public function ConfigCode($file)
    {
        //set configuration filename
        $this->{'configFile'} = $file;
        
        //check if configuration file already exists
        if (file_exists("../".$this->{'configFile'}))
        {
            //load configuration into configs variable.
            $this->{'configuration'} = parse_ini_file("../".$this->{'configFile'});
        } else
        {
            
            //populate our config, and write to file.
            $tmp = [];
            
            $tmp['edit']="edit this file";
            $tmp['database_url']="URL";
            $tmp['database_name']="Name";
            $tmp['database_user']="Username";
            $tmp['database_pass']="Password";
           
            $this->saveConfig();
            
        }

        
    }

    //save config back to file after modification.
    public function saveConfig() 
    {    
        write_php_ini($this->{'configuration'},"../".$this->{'configFile'});
    }

    //load config from file
    public function loadConfig() 
    {
        if (file_exists("../".$this->{'configFile'}))
        {
            $this->$configuration = parse_ini_file("../".$this->{'configFile'});
        } else
        {
            //populate our config, and write to file.
            $this->$configuration['edit']=TRUE;
            $this->$configuration['database_url']="URL";
            $this->$configuration['database_name']="Name";
            $this->$configuration['database_user']="Username";
            $this->$configuration['database_pass']="Password";
            $this->saveConfig();
        }
    }

    


    /**
     * Get the value of configs
     */ 
    public function getConfigs()
    {
        return $this->{'configuration'};
    }

    /**
     * Set the value of configs
     *
     * @return  self
     */ 
    public function setConfigs($configuration)
    {
        $this->{'configuration'} = $configuration;

        return $this;
    }
} 