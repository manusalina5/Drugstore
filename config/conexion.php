<?php

class Conexion{
    private $host = "localhost";
    private $dbname = "drugstore";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConexion(){
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=".$this->host . ";dbname=". $this->dbname,$this->username,$this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Conexion error: " . $exception->getMessage();
        }
        return $this->conn;
    }



}

?>