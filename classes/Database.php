<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "product_management_db";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO ("mysql:host=". $this->host ."; dbname =". $this->dbname , $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMOD, PDO::ERRMOD_EXCEPTION);
        }catch(PDOException $exception){
            echo "erreur de connexion ". $exception->getMessage();
        }

        return $this->conn;

    }


}