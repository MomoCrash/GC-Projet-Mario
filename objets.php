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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="mario bros objet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="icon" type="image/x-icon" href="ressources/icons/mario-icon.png">
        <title> Mario Bros | Objets </title>
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

        <h1 class="title"> OBJETS </h1>

        <div class="AllignObjets">

            <p class="titre-bord3"> POWER-UP </p>

            <div class="objects">
                <a href="#champignon"> 
                    <div class="Cercle">
                        <img class="recto"src="ressources/objects/champi.webp" alt="Champi" >
                        <img class="verso"src="ressources/objects/champi.webp" alt="Champi">
                    </div>
                </a>
                <br>
                <p class="sousTitre" >CHAMPIGNONS</p>
            </div>
            
            <div class="objects">
                <a href="#fleur"> 
                    <div class="Cercle">
                        <img class="recto"src="ressources/objects/feu.webp" alt="Fleur de feu" >
                        <img class="verso"src="ressources/objects/feu.webp" alt="Fleur de feu">
                    </div>
                </a>
                <br>
                <p class="sousTitre">FLEURS</p>
            </div>

            <div class="objects">
                <a href="#special"> 
                    <div class="Cercle">
                        <img class="recto"src="ressources/objects/etoile.webp" alt="Etoile" >
                        <img class="verso"src="ressources/objects/etoile.webp" alt="Etoile">
                    </div>
                </a>
                <br>
                <p class="sousTitre">SPECIALS</p>
            </div>
        </div>

        <br>
        <br>
        <br id="champignon">

        <h2 class="title">CHAMPIGNONS</h2>

        <div class="AllignCarreNoir">
            <div class="contenu">
                <div class="CarreNoir">
                    <img class="imgCarreNoir" src="ressources/objects/champi.webp" alt="Champignon">
                </div>
            </div>
        
            <div class="CarreNoir">
                <p class="textCarreNoir">Le champignon (ou simplement champi) est un objet qui apparait generalement dans
                     les spin-offs des jeux video Mario. Son effet change selon les series. Il a la meme apparence que le super champignon.
                     Selon les jeux ou il apparait, il peut soit rendre des points de vie, donner un coup d'acceleration, ou encore doubler des des.
                     Quelque soit son role, ses effets restent toujours benefiques.
                </p>
            </div>
        </div>

        <div class="AllignCarreNoir">
            <div class="CarreNoir">
                <p class="textCarreNoir">Mega Mario est une transformation de Mario, qu'il obtient en mangeant un Mega Champignon. 
                    Il peut ainsi tout detruire sur son passage, meme les drapeaux.
                    Le joueur n'est pas entierement invincible dans cette forme parce qu'il peut mourir en tombant dans le vide,
                    la lave ou le poison. L'equivalent approximatif de cette transformation pour Bowser est Bowser Geant.
                </p>
            </div>
            
            <div class="CarreNoir">
                <img class="imgCarreNoir" src="ressources/objects/megachampi.webp" alt="Mega Champignon">
            </div>
            
        </div>

        <div class="AllignCarreNoir">
            <div class="contenu">
                <div class="CarreNoir">
                    <img class="imgCarreNoir" src="ressources/objects/poison.webp" alt="Mini Champignon">
                </div>
            </div>
        
            <div class="CarreNoir">
                <p class="textCarreNoir">Le mini champignon, ou mini champi, est un objet de la serie Super Mario. 
                    Il est apparu la premiere fois dans Mario Party 4. 
                    Il permet de devenir minuscule, de pouvoir rebondir sur les ennemis et atteindre des endroits inaccessibles 
                    ou bien encore de courir sur l'eau, rendant son utilisateur vulnerable a toute attaque ennemie et 
                    l'obligeant a utiliser une charge au sol pour les vaincre.
                </p>
            </div>
        </div>
        
        <div class="AllignCarreNoir">
            <div class="CarreNoir">
                <p class="textCarreNoir">Le champignon 1UP est un des objets principaux de la serie Super Mario. 
                    C'est un champignon de couleur verte qui, une fois ramasse, donne une vie supplementaire. 
                    Il peut aussi ranimer un personnage evanoui dans les jeux de role.
                </p>
            </div>
            
            <div class="CarreNoir">
                <img class="imgCarreNoir" src="ressources/objects/vie.webp" alt="Champi 1-UP">
            </div>    
        </div>

        <div class="AllignCarreNoir">

            <div class="CarreNoir">
                <img class="imgCarreNoir" src="ressources/objects/helice.webp" alt="Champi helice">
            </div>

            <div class="CarreNoir">
                <p class="textCarreNoir">Le champignon helice est un objet apparu pour la premiere fois dans 
                    New Super Mario Bros. Wii. Comme son nom l'indique, cet objet est utilise pour permettre au 
                    joueur de voler dans les airs, de tourner comme une helice jusqu'a redescendre doucement vers le sol.
                    C'est un champignon de couleur orange avec des pois jaune pâle sur les deux cotes, 
                    une visiere au-dessus de ses yeux ainsi qu'une helice jaune sur le sommet de sa tete.  
                </p>
            </div>          
        </div>

        <br id="fleur">

        <h2 class="title">FLEURS</h2>

        <div class="AllignCarreNoir">
            <div class="contenu">
                <div class="CarreNoir">
                    <img class="imgCarreNoir" src="ressources/objects/feu.webp" alt="Fleur de feu">
                </div>
            </div>
        
            <div class="CarreNoir">
                <p class="textCarreNoir">La fleur de feu est un des objets les plus recurrents de la franchise Mario.
                     C'est une fleur a tete ovale de couleur jaune, orange et rouge avec des yeux globuleux, apparue pour la premiere fois 
                     dans Super Mario Bros.
                     Elle permet a Mario de se transformer en Mario de feu pour lancer des boules enflammees qui blessent les ennemis. 
                </p>
            </div>
        </div>

        <div class="AllignCarreNoir">
            <div class="CarreNoir">
                <p class="textCarreNoir">La Fleur de glace est un objet apparaissant pour la premiere fois dans Mario & Luigi : Les Freres du Temps. 
                    Pour avoir cette transformation, il faut que le personnage soit dans sa "super" forme (forme Super Mario).Avec la Fleur de glace, 
                    Mario lance donc de la glace qui transforme tout ce qu'il touche en glacon (sauf dans Super Mario Galaxy). 
                    A noter que cette capacite est aussi disponible avec Mario Pingouin.
                </p>
            </div>
            
            <div class="CarreNoir">
                <img class="imgCarreNoir" src="ressources/objects/glace.webp" alt="Fleur de glace">
            </div>          
        </div>

        <div class="AllignCarreNoir">
            <div class="contenu">
                <div class="CarreNoir">
                    <img class="imgCarreNoir" src="ressources/objects/feuille.webp" alt="Suepr feuille">
                </div>
            </div>
        
            <div class="CarreNoir">
                <p class="textCarreNoir">La super feuille est un objet a l'origine uniquement utilise dans la serie Super Mario mais qui, avec le temps, 
                    est apparu dans d'autres series de la franchise Mario. Elle transforme celui qui l'utilise en raton-laveur ou en tanuki qui pourra voler grace a sa queue. 
                    Elle apparait pour la premiere fois dans Super Mario Bros. 3 et reapparait dans Super Mario 3D Land apres plusieurs annees d'absence, puis dans Mario Kart 7 
                    et enfin dans New Super Mario Bros. 2 et Super Mario 3D World. 
                </p>
            </div>
        </div>

        <div class="AllignCarreNoir">
            <div class="CarreNoir">
                <p class="textCarreNoir">Elle permet a Mario et Luigi de se transformer en Mario boomerang. En etant Mario boomerang, Mario peut lancer un boomerang tout comme 
                    le Frere Boomerang. La fleur portant bien son nom est en forme de boomerang. La fleur boomerang est une fleur et non un costume car dans Super Mario Bros. 3, 
                    le Costume marteau ayant les memes capacites que Frere Marto est un costume.
                </p>
            </div>
            
            <div class="CarreNoir">
                <img class="imgCarreNoir" src="ressources/objects/boomerang.webp" alt="Fleur boomerang">
            </div>          
        </div>

        <br id="special">

        <h2 class="title">SPECIALS</h2>

        <div class="AllignCarreNoir">
            <div class="contenu">
                <div class="CarreNoir">
                    <img class="imgCarreNoir" src="ressources/objects/etoile.webp" alt="Super etoile">
                </div>
            </div>
        
            <div class="CarreNoir">
                <p class="textCarreNoir">Les super etoiles sont des objets apparaissant dans plusieurs jeux de la franchise Mario. Lorsque Mario entre en contact avec une super etoile, 
                    il devient invincible. La super etoile a ete introduite des Super Mario Bros..
                </p> 
            </div>
        </div>

        <div class="AllignCarreNoir">
            <div class="CarreNoir">
                <p class="textCarreNoir">Les blocs sont des elements de decor recurrents qui apparaissent dans les jeux video Mario. On les voit la plupart du temps flotter 
                    dans les airs tout en etant immobiles. Ils peuvent autant servir d'obstacle que de bonus, et sont parfois indispensables pour terminer un niveau. 
                    Les blocs existent en plusieurs types.
                </p>
            </div>
            
            <div class="CarreNoir">
                <img class="imgCarreNoir" src="ressources/objects/bloc.webp" alt="Bloc">
            </div>          
        </div>

        <div class="AllignCarreNoir">
            <div class="contenu">
                <div class="CarreNoir">
                    <img class="imgCarreNoir" src="ressources/objects/plume.webp" alt="Super plume">
                </div>
            </div>
        
            <div class="CarreNoir">
                <p class="textCarreNoir">La plume (ou plume acrobate dans Mario Kart 8 Deluxe) est un objet d'abord apparu dans Super Mario World ou elle transforme Mario en Mario cape.
                </p> 
            </div>
        </div>

        <div class="AllignCarreNoir">
            <div class="CarreNoir">
                <p class="textCarreNoir">Mario pingouin est une transformation apparue pour la premiere fois dans New Super Mario Bros. Wii. Mario a besoin d'un costume pingouin pour l'obtenir. 
                    Il est bleu fonce et blanc avec la salopette rouge classique de Mario
                </p>
            </div>
            
            <div class="CarreNoir">
                <img class="imgCarreNoir" src="ressources/objects/pinguin.webp" alt="Pinguin">
            </div>          
        </div>

        




        <footer style="transform: translateY(150px);"> 
            <div class="text">
                <p>Auteur: Gilotin Ethan et PASCAL Noa | Property of ©Nintendo. 2023</p>
            </div>
            <div class="contact">
                <a href="mailto:mariobros@nentendo.fr" style="color: white; text-decoration: none;">Contactez le support</a> |
                <a href="mention-legal.html" style="color: white; text-decoration: none;">Mention legales</a> |
                <a href="mention-legal.html" style="color: white; text-decoration: none;">CGU </a>
            </div>
        </footer>

    </body>
</html>
