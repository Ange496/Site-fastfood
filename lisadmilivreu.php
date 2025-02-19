<?php
include 'connexion.php';

$identifiant_livreur = 1; 
$sql = "SELECT * FROM commande WHERE identifiant_livreur = $identifiant_livreur AND statut_commande != 'livrée'";
$result = $conn->query($sql);

$commandes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $commandes[] = $row;
    }
}

$sql_livrees = "SELECT * FROM commande WHERE identifiant_livreur = $identifiant_livreur AND statut_commande = 'livrée'";
$result_livrees = $conn->query($sql_livrees);

$commandes_livrees = [];
if ($result_livrees->num_rows > 0) {
    while ($row = $result_livrees->fetch_assoc()) {
        $commandes_livrees[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Livreur - Le Festin d'Or</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background:url(ima/t.jpg) no-repeat fixed center;
            background-size: cover;
            color:rgb(255, 255, 255);
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #000000;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo img {
            width: 120px;
            height: auto;
        }
        nav a {
            color:rgb(216, 11, 11);
            text-decoration: none;
            margin-left: 20px;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            background-color:rgba(0, 0, 0, 0.55);
        }
        th {
            background-color:rgba(0, 0, 0, 0.54);
        }
        button {
            background-color:rgb(240, 141, 11);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        button:hover {
            background-color:rgba(228, 19, 19, 0.96);
        }
    

        /* Sous-titres */
        h2 {
            color:rgb(226, 11, 11);
            border-left: 5px solid #333;
            padding-left: 10px;
        }

    </style>
</head>
<body>

<header>
    <div class="logo">
        <a href="index.php">
            <img src="ima/LOGO RESTO.png" alt="Logo Le Festin d'Or">
        </a>
    </div>
    <nav>
        <a href="adminlivreur.php">Accueil Principal</a>
    </nav>
</header>

<div class="container">
    <h1>Menu du Livreur</h1>
</div>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background: url('ima/t.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .logo img {
        width: 120px;
        height: auto;
        border-radius: 10px;
    }

    nav a {
        color: #d80b0b;
        text-decoration: none;
        font-size: 18px;
        font-weight: 600;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    nav a:hover {
        color: #ffdb4d;
        transform: scale(1.1);
    }

    .container {
        padding: 50px;
        text-align: center;
        animation: fadeIn 1.5s ease-out;
    }

    h1 {
        font-size: 3rem;
        color: #e78309;
        margin-bottom: 20px;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        animation: slideIn 1s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

    <h2>Commandes à Livrer</h2>
    <table>
        <tr>
            <th>Numéro de Commande</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Statut</th>
            <th>Adresse</th>
            <th>Client</th>
            <th>Action</th>
        </tr>
        <?php foreach ($commandes as $commande): ?>
            <tr>
                <td><?= htmlspecialchars($commande['numero_de_commande']) ?></td>
                <td><?= htmlspecialchars($commande['date_de_commande']) ?></td>
                <td><?= htmlspecialchars($commande['heure_de_commande']) ?></td>
                <td><?= htmlspecialchars($commande['statut_commande']) ?></td>
                <td><?= htmlspecialchars($commande['nom_rue']) ?></td>
                <td><?= htmlspecialchars($commande['identifiant_client']) ?></td>
                <td>
                    <form method="post" action="statcom.php">
                        <input type="hidden" name="numero_de_commande" value="<?= $commande['numero_de_commande'] ?>">
                        <select name="statut_commande">
                            <option value="en cours" <?= $commande['statut_commande'] == 'en cours' ? 'selected' : '' ?>>En cours</option>
                            <option value="livrée" <?= $commande['statut_commande'] == 'livrée' ? 'selected' : '' ?>>Livrée</option>
                        </select>
                        <button type="submit">Mettre à jour</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Plats Déjà Livrés</h2>
    <table>
        <tr>
            <th>Numéro de Commande</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Adresse</th>
            <th>Client</th>
        </tr>
        <?php foreach ($commandes_livrees as $commande): ?>
            <tr>
                <td><?= htmlspecialchars($commande['numero_de_commande']) ?></td>
                <td><?= htmlspecialchars($commande['date_de_commande']) ?></td>
                <td><?= htmlspecialchars($commande['heure_de_commande']) ?></td>
                <td><?= htmlspecialchars($commande['nom_rue']) ?></td>
                <td><?= htmlspecialchars($commande['identifiant_client']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
