<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client - Le Festin d'Or</title>
    <link rel="icon" href="ima/LOGO RESTO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: orange;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #000000;
            padding: 10px 20px;
        }
        header .logo img {
            height: 50px;
        }
        nav {
            display: flex;
            gap: 20px;
        }
        nav a {
            color:hsl(46, 100.00%, 52.50%);
            text-decoration: none;
            font-weight: bold;
        }
        .cart-icon {
            position: relative;
            width: 30px;
            height: 30px;
        }
        .cart-icon img {
            width: 100%;
            height: 100%;
        }
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            font-size: 12px;
            border-radius: 50%;
            padding: 2px 6px;
        }
        .slideshow {
            display: flex;
            overflow: hidden;
            height: 400px;
            position: relative;
        }
        .slideshow img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .slide-text {
            position: absolute;
            bottom: 300px;
            left: 300px;
            color: #e61c1c;
            padding: 10px;
            border-radius: 7px;
            font-size: 60px;
            background-color: #000;
            animation: text-animate 3s infinite;
        }
        @keyframes text-animate {
            0% { transform: translateY(100px); opacity: 0; }
            50% { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(-100px); opacity: 0; }
        }
        .products {
            display: none;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .product-box {
            background-color: #fff;
            color: #000;
            border-radius: 10px;
            padding: 10px;
            width: 30%;
            text-align: center;
            margin: 10px 0;
            animation: fade-in 1s ease-in-out forwards;
            opacity: 0;
        }
        .product-box img {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }
        .product-box:hover img {
            transform: scale(1.05);
        }
        .product-box .description {
            margin: 10px 0;
        }
        .product-box .price {
            font-weight: bold;
            color: #e63946;
        }
        .product-box button {
            background-color: #e63946;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .product-box button:hover {
            background-color: #d32f2f;
        }
        @keyframes fade-in {
            to { opacity: 1; }
        }

        h1 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: bold;
    color: white;
    background: linear-gradient(45deg,rgba(255, 136, 0, 0.46),rgba(8, 8, 8, 0.45));
    padding: 15px;
    border-radius: 10px;
    text-transform: uppercase;
    letter-spacing: 2px;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

h1:hover {
    transform: scale(1.05);
    box-shadow: 0px 8px 15px rgba(255, 255, 255, 0.63);
}

footer {
       background: linear-gradient(135deg,rgb(0, 0, 0),rgb(255, 153, 0));
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
        <a href="adminclient.php">
            <img src="ima/LOGO RESTO.png" alt="Logo Le Festin d'Or">
        </a>
    </div>
    <nav>
        <a href="noupla.php">Nos Nouveaux Plats</a>
        <a href="nouvcom.php">Commander vos Plats</a>
        <div class="cart-icon">
        <img src="ima/dd.png" alt="Panier">
            <span class="cart-count">0</span>
        </div>
    </nav>
</header>

<div class="slideshow">
    <img src="ima/df.jpg" alt="Image 1">
    <img src="ima/bvo.jpg" alt="Image 2">
    <img src="ima/hj.jpg" alt="Image 3">
    <div class="slide-text">Bienvenue sur Le Festin d'Or</div>
</div>
<h1>NOS PLATS DISPONIBLE</h1>
<div class="products">
    <div class="product-box">
        <img src="ima/fr.jpg" alt="Numero plats : 01-Burger">
        <div class="description">Burger</div>
        <div class="prix">3000FCFA</div>
        <button class="add-to-cart" onclick="ajouterAuPanier('Numero plats: 01',3000, 'ima/fr.jpg')">Commander</button>
    </div>
    <div class="product-box">
        <img src="ima/op.jpg" alt="Numero plats : 02-Pizza">
        <div class="description">Pizza</div>
        <div class="prix">5000FCFA</div>
        <button class="add-to-cart" onclick="ajouterAuPanier('Numero plats: 02', 5000, 'ima/op.jpg')">Commander</button>
    </div>
    <div class="product-box">
        <img src="ima/qq.jpg" alt="Numero plats: 03">
        <div class="description">Croissant et Café</div>
        <div class="prix">2000FCFA</div>
        <button class="add-to-cart" onclick="ajouterAuPanier('Numero plats: 03', 2000, 'ima/qq.jpg')">Commander</button>
    </div>
    <div class="product-box">
        <img src="ima/drt.jpg" alt="Numero plats : 04">
        <div class="description">Poulet Pané et Frite</div>
        <div class="prix">3500FCFA</div>
        <button class="add-to-cart" onclick="ajouterAuPanier('Numero plats: 04', 3500, 'ima/drt.jpg')">Commander</button>
    </div>
    <div class="product-box">
        <img src="ima/er (2).jpg" alt="Numero plats: 05">
        <div class="description">Créole</div>
        <div class="prix">4000FCFA</div>
        <button class="add-to-cart" onclick="ajouterAuPanier('Numero plats: 05', 4000, 'ima/er (2).jpg')">Commander</button>
    </div>
    <div class="product-box">
        <img src="ima/all.jpg" alt="Numero plats : 06">
        <div class="description">Garba au Poulet et Alloco</div>
        <div class="prix">1500FCFA</div>
        <button class="add-to-cart" onclick="ajouterAuPanier('Numero plats: 06', 1500, 'ima/all.jpg')">Commander</button>
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
                <li><a href="adminclient.php">Accueil</a></li>
                <li><a href="noupla.php">Les Nauveautés</a></li>
                <li><a href="nouvcom.php">Faire Une Commande</a></li>
             
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

</body>

<script>
    let panier = [];    
    let panierCount = 0; 
    function ajouterAuPanier(nom, prix, photo) {
        const produit = {
            nom: nom,
            prix: prix,
            photo: photo
        };
        panier.push(produit);
        panierCount++;
        document.querySelector('.cart-count').textContent = panierCount;

        alert(`${nom} ajouté au panier, le Numero du plats vous sera demandé a la commande.Merci de bien voulait le retenir`);
    }

    function afficherLogoPanier() {
        const panierIcon = document.querySelector('.cart-icon');
        panierIcon.innerHTML = `
            <img src="ima/dd.png" alt="Panier">
            <span class="cart-count">0</span>
        `;
    }
    window.onload = afficherLogoPanier;
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slideshow img');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.opacity = i === index ? '1' : '0';
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    setInterval(nextSlide, 3000);
    showSlide(currentSlide);

    setTimeout(() => {
        const productBoxes = document.querySelectorAll('.product-box');
        productBoxes.forEach((box, i) => {
            setTimeout(() => {
                box.style.animationDelay = `${i * 0.25}s`;
                box.style.opacity = 1;
            }, i * 100); 
        });
        document.querySelector('.products').style.display = 'flex';
    }, 500); 
    
</script>
</html>
