<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_fast_food";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$query_plats = "SELECT * FROM plat";
$result_plats = $conn->query($query_plats);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Plats - Le Festin d'Or</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background:url(ima/bn.jpg) no-repeat fixed center;
            background-size: cover;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            padding: 10px 20px;
            height: 70px;
        }

        .logo img {
            width: 90px;
            height: auto;
            filter: brightness(1.5);
        }

        .plats-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .plat-card {
            background-color: rgba(51, 51, 51, 0.9);
            padding: 15px;
            border-radius: 10px;
            margin: 10px;
            width: 250px;
            text-align: center;
        }

        .plat-card img {
            width: 100%;
            height: 150px;
            border-radius: 5px;
            object-fit: cover; 
        }

        .plat-card h3 {
            color: #f1c70c;
            font-size: 18px;
            margin: 10px 0;
        }

        .plat-card p {
            font-size: 14px;
        }
        .plat-card .prix {
            font-weight: bold;
            color: #e63946;
        }

        .plats-container {
        animation: fadeIn 2s ease-in-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .order-button {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 20px;
        background-color: #f1c70c;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .order-button:hover {
        background-color: #e63946;
        transform: scale(1.1);
    }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="ima/LOGO RESTO.png" alt="Logo Le Festin d'Or">
    </div>
</header>

<h2>Nos nouveaux Plats Disponibles</h2>

<div class="plats-container">
    <?php while ($row = $result_plats->fetch_assoc()): ?>
        <div class="plat-card">
            <?php 
                $image_path = !empty($row['image_plat']) ? $row['image_plat'] : 'ima/default.jpg';
            ?>
            <img src="<?= htmlspecialchars($image_path) ?>" alt="<?= htmlspecialchars($row['nom_du_plat']) ?>">
            <h3><?= htmlspecialchars($row['nom_du_plat']) ?></h3>
            <p><?= htmlspecialchars($row['description_plat']) ?></p>
            <p class="prix"><?= number_format($row['tarif_plat'], 1) ?> FCFA</p>
            <p><strong>Nature :</strong> <?= htmlspecialchars($row['nature_plat']) ?></p>
            <p><strong>Type :</strong> <?= htmlspecialchars($row['libelle_type_plat']) ?></p>
            <p><strong>Fast-Food :</strong> <?= htmlspecialchars($row['identifiant_fast_food']) ?></p>
        </div>
    <?php endwhile; ?>
</div>

<a href="nouvcom.php" class="order-button">Commander</a>
<a href="adminclient.php" class="order-button">Retour a l´accueil</a>

</body>
</html>
