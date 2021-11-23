<?php

class Conexion {

    private $driver = "pgsql";
    private $host = "localhost";
    private $port = "5432";
    private $dbname = "postgres";
    private $user = "postgres";
    private $password = "admin";
    private $conn = null;

    public function __construct()
    {
    }

    public function connection()
    {
        try{

            $this->conn = new PDO($this->driver.':host='.$this->host.';port='.$this->port.';dbname='.$this->dbname.';', $this->user, $this->password);
            return $this->conn;

        }catch (Exception $e){
            //return $e->getMessage();
            return $this->conn;
        }
    }
}