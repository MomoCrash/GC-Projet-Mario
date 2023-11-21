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
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/x-icon" href="ressources/icons/mario-icon.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="mario bros personnage">
        <title> Mario Bros | Personnages </title>
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

        <h1 class="title"> PERSONNAGES</h1>

        <span class="span-perso">
            <div class="AllignPerso">

                <p class="bord-titre"> GENTILS </p>

                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Wiki_Mario" target="_blank" > 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Mario1.webp" alt="Mario" >
                            <img class="verso"src="ressources/Personnage2/Mario2.webp" alt="Mario">
                        </div>
                    </a>
                </div>

                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Luigi" target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Luigi1.webp" alt="Luigi">
                            <img class="verso"src="ressources/Personnage2/Luigi2.webp" alt="Luigi">
                        </div>
                    </a> 
                </div>

                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Princesse_Peach" target="_blank" > 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Peach1.webp" alt="Peach">
                            <img class="verso"src="ressources/Personnage2/Peach2.webp" alt="Peach">
                        </div>
                    </a>
                </div>

                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Princesse_Daisy" target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Daisy1.webp" alt="Daisy">
                            <img class="verso"src="ressources/Personnage2/Daisy2.webp" alt="Daisy">
                        </div>
                    </a>
                </div>  

                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Yoshi" target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Yoshi1.webp" alt="Yoshi">
                            <img class="verso"src="ressources/Personnage2/Yoshi2.webp" alt="Yoshi">
                        </div>
                    </a>
                </div>

                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Toad" target="_blank">
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Toad1.webp" alt="Toad">
                            <img class="verso"src="ressources/Personnage2/Toad2.webp" alt="Toad">
                        </div>
                    </a>
                </div> 

                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Toadette" target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Toadette1.webp" alt="Toadette">
                            <img class="verso"src="ressources/Personnage2/Toadette2.webp" alt="Toadette">
                        </div>
                    </a>
                </div>  
            </div>

            <br>

            <div class="AllignPerso2">

                <p class="titre-bord2"> VILAINS </p>

                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Bowser" target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Bowser1.webp" alt="Bowser">
                            <img class="verso"src="ressources/Personnage2/Bowser2.webp" alt="Bowser">
                        </div>
                    </a>
                </div>
        
                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Bowser_Jr." target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/BowserJr1.webp" alt="BowserJr">
                            <img class="verso"src="ressources/Personnage2/BowserJr2.webp" alt="BowserJr">
                        </div>
                    </a> 
                </div>
        
                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Kamek" target="_blank" >
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Kamek1.webp" alt="Kamek">
                            <img class="verso"src="ressources/Personnage2/Kamek2.webp" alt="Kamek">
                        </div>
                    </a>
                </div>
        
                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Terreurs_de_Bowser" target="_blank">  
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Koopalings1.webp" alt="Les terreurs de Bowser">
                            <img class="verso"src="ressources/Personnage2/Koopalings2.webp" alt="Les terreurs de Bowser">
                        </div>
                    </a>
                </div>  
        
                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Carottin" target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Nabbit1.webp" alt="Karottin">
                            <img class="verso"src="ressources/Personnage2/Nabbit2.webp"  alt="Karottin">
                        </div>
                    </a>
                </div>
        
                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Goomba" target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Goomba1.webp" alt="Goomba">
                            <img class="verso"src="ressources/Personnage2/Goomba2.webp" alt="Goomba">
                        </div>
                    </a>
                </div> 
        
                <div class="Personnages">
                    <a href="https://mario.fandom.com/fr/wiki/Koopa_Troopa" target="_blank"> 
                        <div class="CarreRond">
                            <img class="recto"src="ressources/Personnage1/Koopa1.webp" alt="Koopa">
                            <img class="verso"src="ressources/Personnage2/Koopa2.webp"  alt="Koopa">
                        </div>
                    </a>
                </div>  
            </div>

        </span>
    </body>
    <footer> 
        <div class="text">
            <p>Auteur: Gilotin Ethan et PASCAL Noa | Property of ©Nintendo. 2023</p>
        </div>
        <div class="contact">
            <a href="mailto:mariobros@nentendo.fr" style="color: white; text-decoration: none;">Contactez le support</a> |
            <a href="mention-legal.html" style="color: white; text-decoration: none;">Mention legales</a> |
            <a href="mention-legal.html" style="color: white; text-decoration: none;">CGU </a>
        </div>
    </footer>
  
</html>