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
        nav {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            gap: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
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
        /* Styles pour la bannière des partenaires */
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
    

        
    </style>
</head>
<body>

<header>
    <div class="logo">
        <a href="aminfastfood.php">
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
    <a href="fastfdpla.php">DASHBOAD</a>
  
</div>

<!-- Bannière des partenaires -->
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

    // Alterner entre image et vidéo toutes les 3 secondes
    setInterval(nextSlide, 3000);

    // Afficher le premier slide
    showSlide(currentSlide);
</script>

</body>
</html>
