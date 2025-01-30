<?php

// inclure les classes neccessaires

require_once '../classes/Database.php';
require_once '../classes/Product.php';

//connexion a la base de données 

$database = new Database();
$bd = $database->getConnection();

//instancier la classe Product 

$product = new Product($db);

//recuperer tous les produits

$products = $product->readAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Produits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .edit {
            background-color: #4CAF50;
        }
        .delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>

    <h1>Liste des Produits</h1>
    
    <!-- Lien pour ajouter un produit -->
    <a href="add_product.php" style="text-decoration: none; background-color: #007BFF; color: white; padding: 10px 20px; border-radius: 5px;">Ajouter un Produit</a>

    <!-- Tableau des produits -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Date de Création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Parcourir les résultats avec foreach
            foreach ($products->fetchAll(PDO::FETCH_ASSOC) as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['price']) . " XOF</td>";
                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                echo "<td class='actions'>";
                echo "<a href='edit_product.php?id=" . htmlspecialchars($row['id']) . "' class='edit'>Modifier</a>";
                echo "<a href='../process/delete.php?id=" . htmlspecialchars($row['id']) . "' class='delete' onclick='return confirm(\"Voulez-vous vraiment supprimer ce produit ?\");'>Supprimer</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>