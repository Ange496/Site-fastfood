<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_du_livreur = mysqli_real_escape_string($conn, $_POST["nom"]);
    $telephone_du_livreur = mysqli_real_escape_string($conn, $_POST["tel"]);
    $disponibilite_du_livreur = mysqli_real_escape_string($conn, $_POST["disponibilite"]);
    $log_livreur = mysqli_real_escape_string($conn, $_POST["login"]);
    $mot_de_passe_livreur = mysqli_real_escape_string($conn, $_POST["mot_de_pass"]);
    $moyen_de_transport_livreur = mysqli_real_escape_string($conn, $_POST["moyen_transport"]);
    $numero_plaque_livreur = mysqli_real_escape_string($conn, $_POST["numero_plaque"]);
    $type_piece_livreur = mysqli_real_escape_string($conn, $_POST["type_piece"]);
    $numero_piece_livreur = mysqli_real_escape_string($conn, $_POST["numero_piece"]);
    $nom_quartier = mysqli_real_escape_string($conn, $_POST["nom_quartier"]);

    // Gestion des fichiers uploadés
    $upload_directory = 'uploads/';
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }

    $photo_livreur = $_FILES["photo_livreur"]["name"];
    $photo_moyen_transport_livreur = $_FILES["photo_moyen_transport"]["name"];

    $photo_livreur_path = $upload_directory . basename($photo_livreur);
    $photo_moyen_transport_livreur_path = $upload_directory . basename($photo_moyen_transport_livreur);

    // Vérification et déplacement des fichiers
    if (move_uploaded_file($_FILES["photo_livreur"]["tmp_name"], $photo_livreur_path) && 
        move_uploaded_file($_FILES["photo_moyen_transport"]["tmp_name"], $photo_moyen_transport_livreur_path)) {
        
        // Insérer le livreur dans la base de données
        $sql = "INSERT INTO livreur (nom_du_livreur, telephone_du_livreur, disponibilite_du_livreur, log_livreur, mot_de_passe_livreur, moyen_de_transport_livreur, numero_plaque_livreur, photo_livreur, type_piece_livreur, numero_piece_livreur, photo_moyen_transport_livreur, nom_quartier)
                VALUES ('$nom_du_livreur', '$telephone_du_livreur', '$disponibilite_du_livreur', '$log_livreur', '$mot_de_passe_livreur', '$moyen_de_transport_livreur', '$numero_plaque_livreur', '$photo_livreur', '$type_piece_livreur', '$numero_piece_livreur', '$photo_moyen_transport_livreur', '$nom_quartier')";

        if ($conn->query($sql) === TRUE) {
            // Récupérer l'ID généré
            $id_livreur = $conn->insert_id;

            echo "Inscription réussie ! Votre ID livreur est : <strong>$id_livreur</strong>";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Erreur lors du téléchargement des fichiers.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Livreur</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background:url(ima/lp.jpg) no-repeat fixed center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150vh;
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

        input[type="text"], input[type="tel"], input[type="password"], input[type="file"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 80%;
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
            color:rgb(255, 143, 15);
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 10px;
            font-weight: bold;
        }

        .preview-container {
            text-align: center;
            margin: 10px 0;
        }

        .preview-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: none; 
        }
    </style>
</head>
<body>
    <div class="ange">
        <h2>Inscription Livreur</h2>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="tel" name="tel" placeholder="Numéro de téléphone" required>
            <input type="text" name="disponibilite" placeholder="Disponibilité (ex: Disponible/ Pas disponible...)" required>
            <input type="text" name="login" placeholder="Nom d´utilisateur" required>
            <input type="password" name="mot_de_pass" placeholder="Mot de passe" required>
            <input type="text" name="moyen_transport" placeholder="Moyen de transport (ex: Moto, Voiture, Vélo)" required>
            <input type="text" name="numero_plaque" placeholder="Numéro de plaque" required>
            <input type="text" name="type_piece" placeholder="Type de pièce (ex: CNI, Passeport)" required>
            <input type="text" name="numero_piece" placeholder="Numéro de pièce" required>
            <input type="text" name="nom_quartier" placeholder="Nom du quartier" required>

            <label for="photo_livreur">Photo du livreur :</label>
            <input type="file" name="photo_livreur" id="photo_livreur" accept="image/*" required>
            <div class="preview-container">
                <img id="preview_photo_livreur" alt="Aperçu de la photo du livreur">
            </div>

            <label for="photo_moyen_transport">Photo du moyen de transport :</label>
            <input type="file" name="photo_moyen_transport" id="photo_moyen_transport" accept="image/*" required>
            <div class="preview-container">
                <img id="preview_photo_moyen_transport" alt="Aperçu de la photo du moyen de transport">
            </div>

            <button type="submit">S'inscrire</button>

            <div class="links">
                <a href="index.php">Retour à la connexion</a>
            </div>
        </form>
    </div>

    <script>
     
        function previewImage(input, previewElementId) {
            const file = input.files[0]; 
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewElement = document.getElementById(previewElementId);
                    previewElement.src = e.target.result;
                    previewElement.style.display = "block"; 
                };
                reader.readAsDataURL(file); 
            }
        }

        document.getElementById("photo_livreur").addEventListener("change", function() {
            previewImage(this, "preview_photo_livreur");
        });

        document.getElementById("photo_moyen_transport").addEventListener("change", function() {
            previewImage(this, "preview_photo_moyen_transport");
        });
    </script>
</body>
</html>
