<!DOCTYPE html>
<html lang="fr">
<?php
include "php/sql-manager.php";

session_start();
if (isset($_SESSION['name'])) {
  $name = $_SESSION['name'];
} else {
  $name = "Invite";
}
if (isset($_SESSION['admin'])) {
  $admin = $_SESSION['admin'];
} else {
  $admin = 0;
}
session_regenerate_id(true);

$isAdmin = false;
if (isset($admin)) {
  if ($admin == 1) {
    $isAdmin = true;
  }
}
?>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="ressources/icons/mario-icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="mario bros home">
        <title> Mario Bros | Acceuil </title>
    </head>
    <body>

        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">      
            <img src="ressources/icons/mario-icon.png" alt="Nav Menu Icon" style="width: 40px; ">
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php" style="color: white; background-color: rgba(195, 0, 255, 0.329);">Acceuil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php#nouveautes" style="color: white;">Nouveautes</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php#jeux" style="color: white;">jeux</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="personnage.php" style="color: white;">personnages</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="objets.php" style="color: white;">objets</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="https://www.nintendo.fr/Rechercher/Rechercher-299117.html?q=Mario%20Bros&f=147394-5-2-3-1-32-43" style="color: white;">Acheter</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="quiz.php" style="color: white;">quiz</a>
            </li>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="login.php" style="color: white;">connexion</a>
            </li>

            <?php
            
            if ($isAdmin) {
            echo '<li class="nav-item">
                    <a class="nav-link" href="editor.php" style="color: white;">editor</a>
                    </li>';
            }
            
            ?>
        </ul> 

        <h1 id="top-title" class="title" style="margin-bottom: 200px">
            Le monde des Mario Bros
        </h1>

        <span class="visual-span">
            <div class="single-container">
                <p class="single-item">
                    Mario bros <br> <br> <br>
                    La Saga des jeu mario bros commence en 1983 avec le tout premier mario bros sortis sur nes,
                    ce platformer dans le quel vous incanez un plombier: Mario, doit sauvez la princesse du Royaume Champignon: Peach !
                    Ce jeu traverse les epoques jusqu'a aujourd'hui sur Switch avec Mario Bros Wonder. Les derniers ajouts sont le multijoueurs 
                    l'ajout de nouveaux objets tel que les fleurs de glace, les pinguins, les boomrangs qui permettent un enrichissement du gameplay
                    et un renouvellement du gameplay et des mechaniques du jeu
                </p>
            </div>
        </span>

        <br id="nouveautes">

        <h1 class="title" style="margin-bottom: 200px"> Nouveautes </h1>

        <span class="visual-span">
            <div class="dual-container">
                <p class="dual-item">
                     Dernieres nouveautes 
                     <br> <br>  Super Mario est bientot de retour sur Nintendo Switch, avec Super Mario Bros. Wonder. Dans cette aventure au Royaume des Fleurs, les nouveautes sont nombreuses : nouveaux personnages, nouveaux pouvoirs, nouveaux ennemis… 
                </p>
                <img class="dual-item" src="ressources/news/new-game.webp" alt="news mario wonder">
            </div>
        </span>

        <span class="visual-span">
            <div class="dual-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/XRbi9VIdZGg?si=-B9M4lbMDXZ4R2Va" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="dual-item"></iframe>
                <p class="dual-item"> 
                    Test de Mario Wonder. <br> <br>  Voici les premieres images de gameplay du tout nouveau jeu Mario Bros Wonder,
                     disponible exclusivement sur la chaine Youtube officielle de Nintendo. 
                     Ce jeu promet une experience incroyable avec de nouveaux niveaux passionnants, 
                     des graphismes epoustouflants et une jouabilite amelioree. Ne manquez pas cette occasion de plonger dans 
                     l'univers captivant de Mario Wonder et de vivre des aventures palpitantes aux cotes du celebre plombier moustachu.

                </p>
            </div>
        </span>

        <span class="visual-span">
            <div class="dual-container">
                <p class="dual-item"> 
                    La voix de Mario prend ca retraite
                    <br> <br> 
                    Charles Martinet, l'acteur qui prete sa voix a Mario, 
                    a annonce qu'il prendrait sa retraite prochainement. 
                    Son travail en tant que doubleur de Mario a ete salue par les fans du monde entier. 
                    Sa voix reconnaissable et pleine de vie a contribue a rendre le personnage 
                    encore plus attachant et memorable. Alors que Martinet se prepare a quitter le monde du doublage,
                    les fans attendent avec impatience de voir qui prendra la releve et donnera une nouvelle voix a Mario.
                    Son heritage en tant que voix iconique de Mario restera
                    a jamais grave dans l'histoire des jeux video.
                </p>
                <img class="dual-item" src="ressources/news/retraite-news.webp" alt="news retraite charles">
            </div>
        </span>

    </body>

    <h1 id="jeux" class="title"> Les jeux </h1>

    <div class="game-selector">
        <div>
            <a href="game-pages/nes-game.html" aria-label="Goto nes-game.html" >
                <div class="game">
                    <h2>NES</h2>
                    <span>1983</span>
                </div>
            </a>
        </div>
        <div>
            <a href="game-pages/wii-game.html" aria-label="Goto wii-game.html">
                <div class="game">
                    <h2>Wii</h2>
                    <span>2009</span>
                </div>
            </a>
        </div>
        <div>
            <a href="game-pages/wiiu-game.html" aria-label="Goto wii-u.html">
            <div class="game">
                <h2>Wii U</h2>
                <span>2012</span>
            </div>
            </a>
        </div>
        <div>
            <a href="game-pages/switch-game.html" aria-label="Goto wii-switch.html">
                <div class="game">
                    <h2>Switch</h2>
                    <span>2023</span>
                </div>
            </a>
        </div>
      </div>

    <footer style="transform: translateY(500px);"> 

        <div class="contact-form">

            <br>

            <p> Contactez nous</p> <br>
    
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="4" required></textarea><br><br>

            <input type="submit" value="Submit">

            <br>
            <br>
            <br>
    
        </div>

        <div class="text">
            <p>Auteur: Gilotin Ethan et PASCAL Noa | Property of ©Nintendo. 2023</p>
        </div>

        <div class="contact">
            <a href="mention-legal.html" style="color: white; text-decoration: none;">Mention legales</a> |
            <a href="mention-legal.html" style="color: white; text-decoration: none;">CGU </a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
    </footer>
</html>