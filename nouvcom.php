<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_fast_food";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

function generateOrderID($conn) {
    $sql = "SELECT numero_de_commande FROM commande ORDER BY numero_de_commande DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        return intval($row['numero_de_commande']) + 1;
    } else {
        return 1; 
    }
}
$numero_commande = generateOrderID($conn);

$message = "";

$sqlLivreurs = "SELECT identifiant_livreur, nom_du_livreur FROM livreur";
$resultLivreurs = $conn->query($sqlLivreurs);

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifiant_client = $_POST['identifiant_client'];
    $date_commande = $_POST['date_commande'];
    $heure_commande = $_POST['heure_commande'];
    $quantite_commande = $_POST['quantite_commande'];
    $nom_rue = $_POST['nom_rue'];
    $identifiant_livreur = $_POST['identifiant_livreur'];

    $statut_commande = "En attente";

    $sql = $conn->prepare("INSERT INTO commande (numero_de_commande, date_de_commande, heure_de_commande, statut_commande, quantite_commande, nom_rue, identifiant_client, identifiant_livreur) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("isssisii", $numero_commande, $date_commande, $heure_commande, $statut_commande, $quantite_commande, $nom_rue, $identifiant_client, $identifiant_livreur);

    if ($sql->execute()) {
        $message = "<span class='success'>Commande passée avec succès! Numéro : <strong>$numero_commande</strong></span>";
        $numero_commande = generateOrderID($conn);
    } else {
        $message = "<span class='error'>Erreur : " . $conn->error . "</span>";
    }
    $sql->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Commande</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url(ima/com.gif) no-repeat fixed center;
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 75%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: white;
            background-color: black;
            padding: 10px;
            border-radius: 5px;
        }
        form {
            display: grid;
            gap: 15px;
        }
        label {
            font-size: 1.1rem;
        }
        input, select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            width: 97%;
        }
        button {
            padding: 12px 20px;
            background-color: rgb(226, 24, 24);
            color: white;
            border: none;
            border-radius: 35px;
            cursor: pointer;
            font-size: 1.2rem;
            margin-top: 10px;
        }
        button:hover {
            background-color: rgb(248, 146, 11);
        }
        .error {
            color: red;
            font-size: 0.9rem;
        }
        .success {
            color: green;
            font-size: 1.2rem;
            text-align: center;
        }
        .reset-button {
            background-color: rgb(248, 146, 11);
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 1.2rem;
            margin-top: 20px;
            border-radius: 35px;
        }
        .reset-button:hover {
            background-color: rgb(226, 24, 24);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Nouvelle Commande</h2>

    <div class="success">
        <?php echo $message; ?>
    </div>

    <form id="commandeForm" action="nouvcom.php" method="POST">
        <label for="numero_commande">Numéro de Commande :</label>
        <input type="text" name="numero_commande" value="<?php echo $numero_commande; ?>" readonly>

        <label for="identifiant_client">Identifiant Client :</label>
        <input type="text" name="identifiant_client" required>

        <label for="date_commande">Date de Commande :</label>
        <input type="date" name="date_commande" required>

        <label for="heure_commande">Heure de Commande :</label>
        <input type="time" name="heure_commande" required>

        <label for="statut_commande">Statut de Commande :</label>
        <input type="text" value="En attente" readonly>

        <label for="quantite_commande">Numero de plats-Quantité:</label>
        <input type="number" name="quantite_commande" required>

        <label for="nom_rue">Nom de la commune, Quartier et Rue :</label>
        <input type="text" name="nom_rue" required>

        <label for="identifiant_livreur">Livreur :</label>
        <select name="identifiant_livreur" required>
            <option value="">Sélectionnez un livreur</option>
            <?php
            // Réaffichage des livreurs pour le menu déroulant
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sqlLivreurs = "SELECT identifiant_livreur, nom_du_livreur FROM livreur";
            $resultLivreurs = $conn->query($sqlLivreurs);
            while ($livreur = $resultLivreurs->fetch_assoc()) {
                echo "<option value='{$livreur['identifiant_livreur']}'>{$livreur['nom_du_livreur']}</option>";
            }
            $conn->close();
            ?>
        </select>

        <button type="submit">Commander</button>
        <button type="button" class="reset-button" onclick="window.location.href='adminclient.php'">Retour à la page d'accueil</button>
        <button type="button" class="reset-button" onclick="resetForm()">Réinitialiser</button>
    </form>
</div>

<script>
    function resetForm() {
        document.getElementById("commandeForm").reset();
        document.querySelector('.success').innerHTML = '';
    }
</script>

</body>
</html>
