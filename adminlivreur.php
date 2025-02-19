<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livreur - Le Festin d'Or</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #000000;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #000000;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo img {
            width: 120px;
            height: auto;
        }
     
        nav a {
        color: #fff;
        text-decoration: none;
        font-size: 22px;
        font-weight: 600;
        padding: 12px 30px;
        border: 2px solid #d80b0b;
        border-radius: 50px;
        background-color: rgba(0, 0, 0, 0.6);
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    nav a:hover {
        background-color: #d80b0b;
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
    }

    nav a:active {
        transform: scale(0.95);
    }

        .welcome-section {
            background-color:rgb(248, 169, 23);
            padding: 20px;
            text-align: center;
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
        footer {
        background: linear-gradient(135deg,rgb(0, 0, 0),rgb(255, 166, 0));
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
        <a href="adminlivreur.php">
            <img src="ima/LOGO RESTO.png" alt="Logo Le Festin d'Or">
        </a>
    </div>
    <nav>
    <a href="lisadmilivreu.php">Menu Livreur</a>
</nav>

</header>

<div class="welcome-section">
    <h1>Bienvenue, Livreur du Festin d'Or !</h1>
    <p>Gérez vos livraisons, mettez à jour votre profil et accédez à l'assistance.</p>
</div>

<div class="slideshow">
    <img src="ima/qq.gif" alt="Gif de Bienvenue" class="active">
    <img src="ima/tra.jpg" alt="Gif de Bienvenue" class="active">
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
                <li><a href="adminlivreur.php">Accueil</a></li>
                <li><a href="lisadmilivreu.php">Commande à Traiter</a></li>
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
