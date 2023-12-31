<!DOCTYPE html>
<html lang="en">

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

$request =  $conn->prepare("SELECT question,question_type,anwsers,valid_anwsers FROM quiz ORDER BY RAND() LIMIT 10");
$request->execute();

$array_num = [];

while ($row = $request->fetch()) {
  array_push($array_num, $row);
}

$bestScores = $conn->prepare("SELECT name, score FROM scores JOIN users ON scores.user_id = users.user_id ORDER BY score DESC LIMIT 10;");
$bestScores->execute();

if (isset($_SESSION["id"])) {
  $userId = $_SESSION['id'];
}
?>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="quiz.css">
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
      <a class="nav-link" aria-current="page" href="index.php" style="color: white;">Acceuil</a>
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
      <a class="nav-link active" href="quiz.php" style="color: white; background-color: rgba(195, 0, 255, 0.329);">quiz</a>
    </li>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="login.php" style="color: white;"> <?php if (isset($_SESSION['name'])) echo $name; else echo "connexion"; ?></a>
    </li>

    <?php
    
    if ($isAdmin) {
      echo '<li class="nav-item">
              <a class="nav-link" href="editor.php" style="color: white;">editor</a>
            </li>';
    }
    
    ?>
  </ul> 
  
  <div class="vertical-center">
    <div class="container h-100">
      
      <div class="row d-flex justify-content-center">
        
        <div class="md-6 align-self-center">
          <div class="card text-center" style="width: 20rem; height: 35rem; max-height: 50rem;">
            <div class="card-header">
              <h5 id="question-title" class="card-title">Faire le quiz</h5>
              <?php 

                if (isset($name)) {
                  echo '<h6 id="question-subtitle" class="card-subtitle mb-2 text-body-secondary">Bienvenue ' . $name . '</h6>';
                } else {
                  echo '<h6 id="question-subtitle" class="card-subtitle mb-2 text-body-secondary">Connectez-vous</h6>';
                }
              
              ?>
            </div>
            <div class="card-body">
              <ul  id="question-card"> Vous devez repondre a chaque question par une ou plusieurs reponse, choissisez chaque reponse que vous pensez valide puis valider avec "Question suivante" </ul>
              <div id="question-difficulty">
                <button type="button" id="question-easy" class="btn btn-secondary"><div class="quiz-button">Facile</div></button>
                <button type="button" id="question-medium" class="btn btn-secondary"><div class="quiz-button">Moyen</div></button>
                <br><br>
                <button type="button" id="question-hard" class="btn btn-secondary"><div class="quiz-button">Difficile</div></button>
              </div>
            </div>
            <div class="card-footer text-body-secondary">
              <div class="col-5 align-self-center text-center">
                <button type="button" id="question-next" class="btn btn-secondary"><div class="quiz-button">Commencez le Quiz !</div></button>
              </div>
              <br>
              <div id="progress-bar">
                
              </div>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <button type="button" id="question-reset" class="btn btn-secondary"><div class="quiz-button">Recommencer</div></button>
          </div>
        </div>
        <?php 

          if ($isAdmin) {
            echo '<div class="card text-center" style="width: 20rem; height: 10rem; max-height: 50rem;">
                    <div class="card-body">

                      <h5 id="question-title" class="card-title">Outils Admin</h5>

                      <button type="button" id="btn-editor" class="btn btn-secondary"><div class="quiz-button">Editeur de Questions</div></button> <br> <br>
                      
                    </div>
                  </div>';
          }

          ?>
      </div>
    </div>
    
    <?php
    if (isset($userId)) {
      echo '<div class="bestScores" data-service="<?= htmlspecialchars($userId) ?>">';
    }
    ?>
    
    <div class="quiz-question" data-service="<?= htmlspecialchars(json_encode($array_num)) ?>">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/action.js"></script> 

  </body>
</html>