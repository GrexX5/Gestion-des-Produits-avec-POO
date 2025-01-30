<?php

//include des classes

require_once '../classes/Database.php';
require_once '../classes/Product.php';

//creation de connexion

$database = new Database();
$db = $database->getConnection();

//verifier si le formulaire a ete soumis

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $product = new Product($db);

    //recuperer les valeurs du formulaire

    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];

    //ajouter les produits dans la base

    if($product->create()){
        $message = "Produit ajouter avec succes";
    }else{
        $message = "Erreur de l'ajout du produit";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Ajouter un Produit</h1>

    <!-- Affichage du message de succès ou d'erreur -->
    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

    <form method="post">
        <label for="name">Nom du Produit :</label>
        <input type="text" id="name" name="name" required autocomplete="off">

        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="price">Prix :</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <input type="submit" value="Ajouter">
    </form>

    <p><a href="index.php">Retour à la liste des produits</a></p>

</body>
</html>