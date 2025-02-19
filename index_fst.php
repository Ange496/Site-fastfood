<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $log_fast_food = $_POST["login"];
    $mot_de_passe_fast_food = $_POST["mot_de_pass"];
    $nom_fast_food = $_POST["nom"];
    $tel_fast_food = $_POST["tel"];
    $adresse_fast_food = $_POST["adresse"];
    $email_fast_food = $_POST["email"];
    $nom_quartier = $_POST["nom_quartier"];

    $sql = "INSERT INTO Fast_food (log_fast_food, mot_de_passe_fast_food, nom_fast_food, tel_fast_food, adresse_fast_food, email_fast_food, nom_quartier)
            VALUES ('$log_fast_food', '$mot_de_passe_fast_food', '$nom_fast_food', '$tel_fast_food', '$adresse_fast_food', '$email_fast_food', '$nom_quartier')";

    if ($conn->query($sql) === TRUE) {

        $id_fast_food = $conn->insert_id;
        echo "Inscription réussie ! Votre ID fast-food est : <strong>" . $id_fast_food . "</strong>";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Fastfood</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background:url(ima/aa.jpg)   no-repeat fixed center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .ange {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"], input[type="tel"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #e63946;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d32f2f;
        }

        .links {
            margin-top: 15px;
            font-size: 14px;
        }

        .links a {
            color:rgb(255, 166, 0);
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .message {
            font-size: 14px;
            margin-top: 10px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="ange">
        <h2>Inscription Fastfood</h2>

        <!-- Formulaire d'inscription -->
        <form method="POST">
            <input type="text" name="login" placeholder="Nom d´utilisateur" required>
            <input type="password" name="mot_de_pass" placeholder="Mot de passe" required>
            <input type="text" name="nom" placeholder="Nom de FasFood" required>
            <input type="tel" name="tel" placeholder="Numéro de téléphone" required>
            <input type="text" name="adresse" placeholder="Adresse" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="nom_quartier" placeholder="Nom du quartier" required>
            <button type="submit">S'inscrire</button>

            <div class="links">
                <a href="index.php">Retour à la connexion</a>
            </div>
        </form>
    </div>
</body>
</html>
