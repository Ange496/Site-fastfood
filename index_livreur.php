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
