<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_client = $_POST["nom_client"];
    $telephone_client = $_POST["telephone_client"];
    $adresse_client = $_POST["adresse_client"];
    $email_client = $_POST["email_client"];
    $log_client = $_POST["log_client"];
    $mot_de_passe_client = $_POST["mot_de_passe_client"];
    
    $sql = "INSERT INTO client (nom_client, telephone_client, adresse_client, email_client, log_client, mot_de_passe_client)
            VALUES ('$nom_client', '$telephone_client', '$adresse_client', '$email_client', '$log_client', '$mot_de_passe_client')";

    if ($conn->query($sql) === TRUE) {
   
        $id_client = $conn->insert_id;
        echo "Inscription réussie ! Votre ID client est : <strong>" . $id_client . "</strong>";
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
    <title>Inscription Client</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background :url(ima/er.jpg)   no-repeat fixed center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(245, 162, 7, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="tel"] {
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
            color:rgb(255, 162, 23);
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
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Inscription Client</h2>

        <form method="POST" action="">
            <input type="text" name="nom_client" placeholder="Nom" required>
            <input type="tel" name="telephone_client" placeholder="Téléphone" required>
            <input type="text" name="adresse_client" placeholder="Adresse" required>
            <input type="email" name="email_client" placeholder="Email" required>
            <input type="text" name="log_client" placeholder="Nom d´utilisateur" required>
            <input type="password" name="mot_de_passe_client" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>

        <div class="links">
            <a href="index.php">Retour à la connexion</a>
        </div>
    </div>
</body>
</html>
