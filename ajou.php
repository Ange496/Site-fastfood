<?php
ob_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_fast_food";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$query_fast_foods = "SELECT * FROM Fast_food";
$result_fast_foods = $conn->query($query_fast_foods);

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_du_plat = $_POST['nom_du_plat'];
    $description_plat = $_POST['description_plat'];
    $tarif_plat = $_POST['tarif_plat'];
    $nature_plat = $_POST['nature_plat'];
    $libelle_type_plat = $_POST['libelle_type_plat'];
    $identifiant_fast_food = $_POST['identifiant_fast_food'];

 
    if (isset($_FILES['image_plat'])) {
        $image_name = $_FILES['image_plat']['name'];
        $image_tmp_name = $_FILES['image_plat']['tmp_name'];
        $image_folder = "ima/" . $image_name;
        move_uploaded_file($image_tmp_name, $image_folder);
    }
    $query = "INSERT INTO plat (nom_du_plat, description_plat, tarif_plat, statut_plat, image_plat, nature_plat, libelle_type_plat, identifiant_fast_food) 
              VALUES ('$nom_du_plat', '$description_plat', '$tarif_plat', 1, '$image_folder', '$nature_plat', '$libelle_type_plat', '$identifiant_fast_food')";

    if ($conn->query($query) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
        exit();
    } else {
        $error_message = "Erreur : " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Plat - Le Festin d'Or</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url(ima/tru.jpg) no-repeat fixed center;
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
        .form-container {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 600px;
            text-align: left;
        }
        .form-container input,
        .form-container select,
        .form-container button,
        .form-container textarea {
            width: 98%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .form-container button {
            background-color: #e63946;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .form-container button:hover {
            background-color: #f1c70c;
        }
        .message {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
        .message.success {
            color: #0f0;
        }
        .message.error {
            color: #f00;
        }
        .order-button {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 20px;
        background-color: #f1c70c;
        color: #333;
        text-decoration: none;
        border-radius: 10px;
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

<?php if (isset($_GET['success'])): ?>
    <div class="message success">Plat ajouté avec succès.</div>
<?php elseif (!empty($error_message)): ?>
    <div class="message error"><?php echo $error_message; ?></div>
<?php endif; ?>

<div class="form-container">
    <h2>Ajouter un Plat</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="nom_du_plat" placeholder="Nom du plat" required>
        <textarea name="description_plat" placeholder="Description du plat" required></textarea>
        <input type="number" step="1" name="tarif_plat" placeholder="Tarif" required>
        <input type="text" name="nature_plat" placeholder="Nature du plat" required>
        <input type="file" name="image_plat" accept="image/*" required>
        <select name="libelle_type_plat" required>
            <option value="">Sélectionner le type de plat</option>
            <option value="Petit-Déjeuner">Petit-Déjeuner</option>
            <option value="Déjeuner">Déjeuner</option>
            <option value="Gouter">Gouter</option>
            <option value="Diner">Diner</option>
        </select>
        
        <select name="identifiant_fast_food" required>
            <option value="">Sélectionner le Fast-Food</option>
            <?php while ($row = $result_fast_foods->fetch_assoc()): ?>
                <option value="<?php echo $row['identifiant_fast_food']; ?>">
                    <?php echo $row['nom_fast_food']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Ajouter</button>
    <button type="reset">Réinitialiser</button>
    <a href="adminfastfood.php" class="order-button">Retour a l´accueil</a>
    </form>
</div>

</body>
</html>
<?php
ob_end_flush(); 
?>
