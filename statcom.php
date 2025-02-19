<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_de_commande = $_POST['numero_de_commande'];
    $statut_commande = $_POST['statut_commande'];

    $sql = "UPDATE commande SET statut_commande = '$statut_commande' WHERE numero_de_commande = $numero_de_commande";

    if ($conn->query($sql) === TRUE) {
        echo "Statut de la commande mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du statut: " . $conn->error;
    }

    $conn->close();
}
?>
