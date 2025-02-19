<?php 
$pdo = new PDO('mysql:host=localhost;dbname=bd_fast_food', 'root', '');

$commandesQuery = $pdo->query('SELECT * FROM commande');
$commandes = $commandesQuery->fetchAll(PDO::FETCH_ASSOC);

$livreursQuery = $pdo->query('SELECT * FROM livreur');
$livreurs = $livreursQuery->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['update_status'])) {
    $stmt = $pdo->prepare('UPDATE commande SET statut_commande = ? WHERE numero_de_commande = ?');
    $stmt->execute([$_POST['new_status'], $_POST['numero_de_commande']]);
    echo 'Statut de la commande mis à jour avec succès.';
}

$role = isset($_POST['role']) ? $_POST['role'] : '';
$log_user = isset($_POST['log_user']) ? $_POST['log_user'] : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Fast-Food</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url(ima/fast.gif) no-repeat fixed center;
            background-size: cover;
            color: white;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 15px;
            border-radius: 10px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        button, a {
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
            transition: 0.3s;
            display: inline-block;
            cursor: pointer;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        button:hover {
            background-color: #45a049;
        }
        a.commander, a.livrer, a.livreurs {
            color: white;
            background-color: red;
        }
        a:hover {
            opacity: 0.8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: rgba(255, 255, 255, 0.2);
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .status-select {
            padding: 5px;
            border-radius: 5px;
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
    <h1>Gestion du Fast-Food</h1>
    <div class="container">
        <div style="text-align: center;">
            <a href="#" onclick="showOrders('commande')" class="commander">Plats Commandés</a>
            <a href="#" onclick="showLivreurs()" class="livreurs">Liste des Livreurs Disponibles et des Plats Livrés</a>
            <a href="adminfastfood.php" class="order-button">Retour a l´accueil</a>
        </div>
        <div id="order-list">
            <table>
                <tr>
                    <th>Numéro de Commande</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Quantité</th>
                    <th>Rue</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($commandes as $commande): ?>
                <tr id="commande-<?= $commande['numero_de_commande'] ?>">
                    <td><?= htmlspecialchars($commande['numero_de_commande']) ?></td>
                    <td><?= htmlspecialchars($commande['date_de_commande']) ?></td>
                    <td><?= htmlspecialchars($commande['heure_de_commande']) ?></td>
                    <td><?= htmlspecialchars($commande['quantite_commande']) ?></td>
                    <td><?= htmlspecialchars($commande['nom_rue']) ?></td>
                    <td id="status-<?= $commande['numero_de_commande'] ?>"><?= htmlspecialchars($commande['statut_commande']) ?></td>
                    <td>
                        <select name="new_status" onchange="updateStatus(<?= $commande['numero_de_commande'] ?>)">
                            <option value="enregistrer" <?= $commande['statut_commande'] == 'enregistrer' ? 'selected' : '' ?>>Enregistrée</option>
                            <option value="prise en compte" <?= $commande['statut_commande'] == 'prise en compte' ? 'selected' : '' ?>>Prise en compte</option>
                            <option value="en cours de livraison" <?= $commande['statut_commande'] == 'en cours de livraison' ? 'selected' : '' ?>>En cours de livraison</option>
                            <option value="livree" <?= $commande['statut_commande'] == 'livree' ? 'selected' : '' ?>>Livrée</option>
                        </select>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Livreurs List -->
        <div id="livreur-list" style="display: none;">
            <table>
                <tr>
                    <th>Nom du Livreur</th>
                    <th>Téléphone</th>
                    <th>Disponibilité</th>
                    <th>Transport</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($livreurs as $livreur): ?>
                <tr>
                    <td><?= htmlspecialchars($livreur['nom_du_livreur']) ?></td>
                    <td><?= htmlspecialchars($livreur['telephone_du_livreur']) ?></td>
                    <td><?= htmlspecialchars($livreur['disponibilite_du_livreur']) ?></td>
                    <td><?= htmlspecialchars($livreur['moyen_de_transport_livreur']) ?></td>
                    <td><img src="<?= htmlspecialchars($livreur['photo_livreur']) ?>" alt="Photo" width="50"></td>
                    <td><button onclick="assignOrder(<?= $livreur['identifiant_livreur'] ?>)">Attribuer Commande</button></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <script>
        function showOrders(type) {
            const orderList = document.getElementById('order-list');
            orderList.style.display = type === 'commande' ? 'block' : 'none';
            const livreurList = document.getElementById('livreur-list');
            livreurList.style.display = 'none';
        }

        function showLivreurs() {
            const livreurList = document.getElementById('livreur-list');
            livreurList.style.display = 'block';
            const orderList = document.getElementById('order-list');
            orderList.style.display = 'none';
        }

        function updateStatus(commandeId) {
            const newStatus = document.querySelector(`#commande-${commandeId} select`).value;
            const statusCell = document.querySelector(`#status-${commandeId}`);
            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `numero_de_commande=${commandeId}&new_status=${newStatus}`
            })
            .then(response => response.text())
            .then(data => {
                statusCell.textContent = newStatus; 
            })
            .catch(error => console.error('Erreur:', error));
        }

        function assignOrder(livreurId) {
            alert('Commande attribuée au livreur ' + livreurId);
        }
        function updateStatus(commandeId) {
    const newStatus = document.querySelector(`#commande-${commandeId} select`).value;
    const statusCell = document.querySelector(`#status-${commandeId}`);

    fetch('update_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `numero_de_commande=${commandeId}&new_status=${newStatus}`
    })
    .then(response => response.text())
    .then(data => {
       
        statusCell.textContent = newStatus;

        if (newStatus === 'livree') {
            setTimeout(() => {
                if (confirm('Statut modifié : Commande livrée. Voulez-vous l\'afficher dans la liste des plats livrés ?')) {
                    moveOrderToDelivered(commandeId);
                }
            }, 300); 
        }
    })
    .catch(error => console.error('Erreur:', error));
}

function moveOrderToDelivered(commandeId) {
    const commandeRow = document.getElementById(`commande-${commandeId}`);

    if (commandeRow) {
   
        commandeRow.style.display = 'none';

        const deliveredTable = document.querySelector('#livreur-list table');

        if (deliveredTable) {
            deliveredTable.appendChild(commandeRow);
            commandeRow.style.display = 'table-row'; 
        }

        showOrders('livre');
    }
}
    </script>
</body>
</html>
