<?php

class Conexion{
    private $host;
    private $dbname;
    private $username;
    private $pass;
    private $conn;

    public function __construct(){
        $this->host = "localhost";
        $this->dbname = "mydb";
        $this->username = "root";
        $this->pass = "Todounpalo98";
    }

    public function conectar(){
        $this->conn = new mysqli($this->host, $this->username,$this->pass, $this->dbname);
    }

    public function desconectar() {
        $this->conn->close();
}

    public function consultar($query){
        $this->conectar();
        $resultado = $this->conn->query($query);
        $this->desconectar();
        return $resultado;
    }

    public function insertar($query){
        $this->conectar();
        $this->conn->query($query);
        $id = $this->conn->insert_id;
    }

    public function actualizar($query){
        $this->conectar();
        $resultado = $this->conn->query($query);
        $this->desconectar();
        return $resultado;


}


}

