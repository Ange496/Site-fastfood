<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start(); 

    $role = isset($_POST["role"]) ? $_POST["role"] : '';
    $log_user = isset($_POST["log_user"]) ? mysqli_real_escape_string($conn, $_POST["log_user"]) : '';
    $mot_de_pass_user = isset($_POST["mot_de_pass_user"]) ? mysqli_real_escape_string($conn, $_POST["mot_de_pass_user"]) : '';

    switch ($role) {
        case 'client':
            $table = 'client';
            $log_field = 'log_client';
            $pass_field = 'mot_de_passe_client';
            $redirect = 'adminclient.php';
            break;

        case 'livreur':
            $table = 'livreur';
            $log_field = 'log_livreur';
            $pass_field = 'mot_de_passe_livreur';
            $redirect = 'adminlivreur.php';
            break;

        case 'fast_food':
            $table = 'fast_food';
            $log_field = 'log_fast_food';
            $pass_field = 'mot_de_passe_fast_food';
            $redirect = 'adminfastfood.php';
            break;
            
        default:
            $_SESSION['error'] = "Type d'utilisateur non valide.";
            header("Location: connexion.php");
            ob_end_flush(); 
            exit();
    }


    $sql = "SELECT * FROM $table WHERE $log_field='$log_user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($mot_de_pass_user, $user[$pass_field])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $role;
            $_SESSION['user_log'] = $log_user;

            header("Location: $redirect");
            ob_end_flush(); 
            exit();
        } else {
            $_SESSION['error'] = "Mot de passe incorrect.";
        }
    } else {
        $_SESSION['error'] = "Cet utilisateur n'est pas inscrit.";
    }

    header("Location: connexion.php");
    ob_end_flush(); 
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="icon" href="ima/LOGO RESTO.png">

  <style>

    body {
      font-family: Arial, sans-serif;
      background-color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      position: relative;
    }

    .logo-container {
      position: absolute;
      top: 20px;
      left: 20px;
    }

    .logo-container img {
      width: 100px;
      filter: drop-shadow(0 0 10px #fff);
    }

    .container {
      position: relative;
      max-width: 800px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgb(255, 0, 0);
      overflow: hidden;
      background-color: #fff;
      display: flex;
      flex-direction: column;
    }

    .form-content {
      display: flex;
      flex: 1;
    }

    .form-content img {
      width: 50%;
      height: 100%;
      object-fit: cover;
    }

    .form-container {
      width: 50%;
      padding: 30px;
      background-color: rgba(255, 255, 255, 0.53);
      z-index: 1;
    }

    h2 {
      margin-bottom: 20px;
      color:rgb(0, 0, 0);
      text-align: center;
    }

    select, input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 5px;
      color: red;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #e63946;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color:rgb(233, 129, 32);
    }

    .liens {
      margin-top: 15px;
      font-size: 14px;
      text-align: center;
    }

    .liens a {
      color:rgb(0, 0, 0);
      text-decoration: none;
    }

    .liens a:hover {
      text-decoration: underline;
      background-color: chocolate;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-top: 10px;
    }

    .message {
    color:rgb(247, 142, 5); 
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    background-color: #f8d7da; 
    padding: 10px;
    border-radius: 5px;
}
  </style>
  
</head>
<body>

  <div class="logo-container">
    <img src="ima/LOGO RESTO.png" alt="Logo">
  </div>

  <div class="container">
    <div class="form-content">
      <img src="ima/gt.gif" alt="Image">
      <div class="form-container">

        <h2>BIENVENUE SUR LE FESTIN D´OR</h2>
        <h3 class="message">Veuillez vous inscrire avant de vous connectez</h3>
        <form method="POST" action="javascript:void(0);" onsubmit="redirigerUtilisateur()">

          <select name="role" id="food">
            <option value="">PRESENTEZ-VOUS</option>
            <option value="client">Client</option>
            <option value="livreur">Livreur</option>
            <option value="fast_food">Fast-Food</option>
          </select>

          <div id="connexion-form">
            <input type="text" name="log_user" id="login" placeholder="Nom d´utilisateur" required>
            <input type="password" name="mot_de_pass_user" id="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
          </div>
        </form>

        <div class="liens">
          <a href="javascript:void(0)" onclick="formulaireInscription()">S'inscrire</a> | <a href="mdp.php">Mot de passe oublié ?</a>
        </div>
      </div>
    </div>
  </div>

  <script>

    function redirigerUtilisateur() {
      const role = document.getElementById("food").value;
      if (role === "") {
        alert("Veuillez sélectionner un type d'utilisateur");
        return;
      }
      if (role === 'client') {
        window.location.href = 'adminclient.php';
      } else if (role === 'livreur') {
        window.location.href = 'adminlivreur.php';
      } else if (role === 'fast_food') {
        window.location.href = 'adminfastfood.php';
      }
    }

    function formulaireInscription() {
      const role = document.getElementById("food").value;
      if (role === "") {
        alert("Veuillez sélectionner un type d'utilisateur");
        return;
      }
      if (role === 'client') {
        window.location.href = 'index_client.php';
      } else if (role === 'livreur') {
        window.location.href = 'index_livreur.php';
      } else if (role === 'fast_food') {
        window.location.href = 'index_fst.php';
      }
    }

  </script>

</body>
</html>