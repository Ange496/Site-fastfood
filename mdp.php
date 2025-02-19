<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = '1';
}

if (!isset($_SESSION['mot_de_passe_client'])) {
    $_SESSION['mot_de_passe_client'] = password_hash("ancienmdp", PASSWORD_BCRYPT);
}

$message = "";
$showMessage = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nouveau_mdp = $_POST['nouveau_motdepasse'];
    $confirmer_mdp = $_POST['confirmer_motdepasse'];

    if ($nouveau_mdp !== $confirmer_mdp) {
        $message = "<p class='error'>Les mots de passe ne correspondent pas.</p>";
    } else {
        $_SESSION['mot_de_passe_client'] = password_hash($nouveau_mdp, PASSWORD_BCRYPT);
        $message = "<p class='success'>Mot de passe mis à jour avec succès.</p>";
    }
    $showMessage = true; 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url(ima/qaz.jpg) no-repeat fixed center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #e63946;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #d32f2f;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-top: 10px;
        }

        .liens a {
            color:rgb(252, 132, 19);
            text-decoration: none;
        }

        .liens a:hover {
            text-decoration: underline;
        }

        #messageBox {
            display: none; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Réinitialisation de votre mot de passe</h2>
        <form method="POST" id="resetForm">
            <input type="password" name="nouveau_motdepasse" placeholder="Nouveau mot de passe" required>
            <input type="password" name="confirmer_motdepasse" placeholder="Confirmer le mot de passe" required>
            <button type="submit">Réinitialiser le mot de passe</button>
        </form>

        <div id="messageBox"><?php echo $message; ?></div>

        <div class="liens">
            <a href="index.php">Retour à la connexion</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if ($showMessage) { ?>
                const messageBox = document.getElementById("messageBox");
                messageBox.style.display = "block";
                
               
                setTimeout(function() {
                    messageBox.style.display = "none";
                }, 5000); 
            <?php } ?>
        });
    </script>
</body>
</html>
