<?php

class Product{

    private $conn;
    private $table = "products";

    public $id;
    public $name;
    public $description;
    public $price;

    public function __condtuct($db){
        $this->conn = $db;
    }

    //lire tous nos produits

    public function readAll(){
        $allProducts = $this->conn->prepare("SELECT* FROM". $this->table ."ORDER BY created_at DESC");
        $allProducts->execute();
        return $allProducts;
    }

    //Ajouter un produit

    public function create(){
        $addProduct = $this->conn->prepare("INSERT INTO". $this->table ."(name,description,price) VALUES (:name, :description, :price)");

        //protection contre les injection SQL
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));

        //binder les parametres

        $allProducts->bindParam(":name", $this->name);
        $allProducts->bindParam(":description", $this->description);
        $allProducts->bindParam(":price", $this->price);

        if($allProducts->execute()){return true;}
        return false;


    }

    //lire un seul produit

    public function readOne(){
        $oneProduct = $this->conn->prepare("SELECT INTO". $this->table ."WHERE id = ? LIMIT 0,1");
        $oneProduct->bindParam(1, $this->id);
        $oneProduct->execute();
        return $oneProduct->fetch();
    }

    //mettre à jor un produit 

    public function update(){
        $updateProduct = $this->conn->prepare("UPDATE ". $this->table ."SET name = :name , description = :description , price = :price WHERE id = :id");

        //protection contre les injestions SQL

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));

        //binder les parametres

        $updateProduct->bindParam(":name", $this->name);
        $updateProduct->bindParam(":description", $this->description);
        $updateProduct->bindParam(":price", $this->price);
        $updateProduct->bindParam(":id", $this->id);

        if($updateProduct->execute()){return true;}
        return false ;
    }


    //supprimer un produit

    public function delete(){
        $deleteProduct = $this->conn->prepare("DELETE FROM". $this->table ."WHERE id = :id");

        $this->id = htmlspecialchars(strip_tags($this->id));

        $deleteProduct->bindParam(":id", $this->id);

        if($deleteProduct->execute()){return true ;}
        return false ;
    }



    
}