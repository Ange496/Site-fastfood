<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_fast_food";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}


$query = "SELECT * FROM type_plat"; 
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast-Food - Le Festin d'Or</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        header {
            position: relative;
            background-color: #000000;
            padding: 10px 20px;
            height: 70px;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .logo img {
            width: 90px;
            height: auto;
            filter: brightness(1.5);
        }
        .slideshow {
            position: relative;
            overflow: hidden;
            height: 500px;
        }
        .slideshow img,
        .slideshow video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .slideshow img.active,
        .slideshow video.active {
            opacity: 1;
        }
        .slide-logo {
            position: absolute;
            bottom: 10px;
            left: 10px;
            width: 50px;
            height: auto;
            filter: brightness(1.5);
        }
        .welcome-text {
            text-align: center;
            font-size: 30px;
            color: #f5ca0c;
            margin: 20px 0;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 40px ; 
        }
        .button-container a {
            background-color: #e63946;
            color: #fff;
            padding: 20px 20px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }
        .button-container a:hover {
            background-color: #f1c70c;
        }
      
        .partner-banner {
            background-color: #000000;
            padding: 40px 0;
        }
        .partner-banner h2 {
            color: #ffc70e;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }
        .partners-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            padding: 0 20px;
        }
        .partner {
            width: 150px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        .partner img {
            max-width: 100%;
            max-height: 100%;
        }
        .partner:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
        .form-container {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 600px;
        }
        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
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
       
        footer {
            background: linear-gradient(135deg,rgb(0, 0, 0),rgb(255, 187, 0));
        color: white;
        padding: 40px 0;
        font-family: Arial, sans-serif;
    }

    .footer-container {
        width: 85%;
        margin: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        text-align: center;
    }

    .footer-logo img {
        width: 100px;
        margin-bottom: 3px;
    }

    .footer-logo p {
        font-size: 16px;
        font-style: italic;
        opacity: 0.8;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
    }

    .footer-links ul li {
        margin: 5px 0;
    }

    .footer-links ul li a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .footer-links ul li a:hover {
        color: #fddb3a;
        text-decoration: underline;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .social-icons img {
        width: 30px;
        transition: transform 0.3s ease;
    }

    .social-icons img:hover {
        transform: scale(1.2);
    }

    .footer-bottom {
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
        background: rgba(0, 0, 0, 0.1);
        padding: 10px;
    }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <a href="adminfastfood.php">
            <img src="ima/LOGO RESTO.png" alt="Logo Le Festin d'Or">
        </a>
    </div>
</header>

<div class="welcome-text">
    Bienvenue Cher Partenaire Fast-Food
</div>

<div class="slideshow">
    <img src="ima/eet.jpg" alt="Image 1" class="active">
    <video src="ima/tt.mp4" muted autoplay loop></video>
    <img src="ima/LOGO RESTOe.jpg" alt="Logo" class="slide-logo">
</div>

<div class="button-container">
    <a href="fastfdpla.php">Menu Fast-Food</a>
    <a href="ajou.php">Ajouter un plats</a>
</div>

<div class="partner-banner">
    <h2>Nos Partenaires</h2>
    <div class="partners-container">
        <div class="partner">
            <a href="https://burgerking.com.cy" target="_blank">
                <img src="ima/po.jpg" alt="BURGER KING">
            </a>
        </div>
        <div class="partner">
            <a href="https://www.mcdonalds.com" target="_blank">
                <img src="ima/io.jpg" alt="McDonald's">
            </a>
        </div>
        <div class="partner">
            <a href="https://www.kfccotedivoire.com" target="_blank">
                <img src="ima/ty.jpg" alt="KFC">
            </a>
        </div>
    </div>
</div>
<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <img src="ima/LOGO RESTO.png" alt="Le Festin d'Or">
            <p>Le goût de la perfection</p>
        </div>
        <div class="footer-links">
            <h3>Navigation</h3>
            <ul>
                <li><a href="adminfastfood.php">Accueil</a></li>
                <li><a href="fastfdpla.php">Menu</a></li>
                <li><a href="ajou.php">Ajouter un plat</a></li>
            </ul>
        </div>
        <div class="footer-social">
            <h3>Suivez-nous</h3>
            <div class="social-icons">
            <a href="https://fr-fr.facebook.com/"><img src="ima/facebook (1).png" alt="Facebook"></a>
                <a href="https://x.com/home"><img src="ima/twitter (1).png" alt="Twitter"></a>
                <a href="https://www.instagram.com/"><img src="ima/instagram.png" alt="Instagram"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 Le Festin d'Or | Tous droits réservés | Designed by ANGESPIRIT</p>
    </div>
</footer>


<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slideshow img, .slideshow video');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    setInterval(nextSlide, 3000);

    showSlide(currentSlide);
</script>

</body>
</html>
