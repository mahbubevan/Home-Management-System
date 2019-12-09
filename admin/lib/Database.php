<?php
class Database{
    private $host;
    private $db_name;
    private $password;
    private $user;

    private $link;
    private $error;

    public function __construct(){
        $this->host = HOST;
        $this->db_name = DB_NAME;
        $this->user = DB_USER;
        $this->password = PASSWORD;

        $this->connectDB();
    }

    public function connectDB(){
        $this->link = new mysqli($this->host,$this->user,$this->password,$this->db_name);
        if($this->link){
            return $this->link;
        }else{
            $this->error = "Connection Failed ".$this->link->connect_error;
        }
    }

    // SELECT or READ DATA

    public function select($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result->num_rows >0){
            return $result;
        }else{
            return false;
        }
    }

    // INSERT DATA

    public function insert($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    // Update Data
    public function update($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    //Delete Data

    public function delete($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
    
}