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

$isAdmin = false;
if (isset($admin)) {
  if ($admin == 1) {
    $isAdmin = true;
  }
}

$currentMethod = "login";
if (isset($_GET["method"])) {
  $currentMethod = $_GET["method"];
}

if ($currentMethod == "login") {
  $opositeMethod = "register";
} else {
  $opositeMethod = "login";
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
      <a class="nav-link" aria-current="page" href="index.html" style="color: white;">Acceuil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.html#nouveautes" style="color: white;">Nouveautes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.html#jeux" style="color: white;">jeux</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="personnage.html" style="color: white;">personnages</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="objets.html" style="color: white;">objets</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://www.nintendo.fr/Rechercher/Rechercher-299117.html?q=Mario%20Bros&f=147394-5-2-3-1-32-43" style="color: white;">Acheter</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="quiz.php" style="color: white;">quiz</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="login.php" style="color: white; background-color: rgba(195, 0, 255, 0.329);">connexion</a>
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
          <div class="card text-center" style="width: 20rem; height: 30rem; max-height: 50rem;">
            <div class="card-header">
              <h5 id="question-title" class="card-title">Changer votre mot de passe</h5>
            </div>
            <div class="card-body">
            <form action="<?= 'new-password.php?token=' . $_GET["token"] ?>" method="post">               
                <div class="form-group">
                <label for="Mot de passe">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="emailInput" placeholder="Mot de passe" name="password">
                <label for="Mot de passe">Retapez votre mot de passe</label>
                <input type="password" class="form-control" id="emailInput" aria-describedby="passwordDetail" placeholder="Repeter le mot de passe" name="repeat-password">
                <small id="passwordDetail" class="form-text text-muted">Entrez votre nouveau mot de passe.</small>
                <button type="submit" name="submit"> Envoyer </button>
                </div>
            </form>
            <?php

                if (isset($_POST["submit"])) {

                    $token = $_GET["token"];

                    $tokenRequest =  $conn->prepare("SELECT * FROM reset_tokens WHERE token='" . $token . "';");
                    $tokenRequest -> execute();

                    $count = $tokenRequest -> rowCount();
                    $tokenRow  = $tokenRequest -> fetch();

                    $id = $tokenRow["user_id"];

                    if ($count > 0) {

                        $userRequest =  $conn->prepare("SELECT * FROM users WHERE user_id='" . $id . "';");
                        $userRequest->execute();

                        $count = $userRequest->rowCount();

                        if ($count > 0) {

                            $password = $_POST["password"];
                            $reapeatPassword = $_POST["repeat-password"];

                            if ($password == $reapeatPassword) {

                                $resetToken =  $conn->prepare("DELETE FROM reset_tokens WHERE user_id='" . $id . "';");
                                $resetToken -> execute();

                                $resetPassword =  $conn->prepare("UPDATE users SET password='" . password_hash($password, PASSWORD_DEFAULT) . "' WHERE user_id='" . $id . "';");
                                $resetPassword -> execute();

                                header('Location: login.php?method=login');
                                exit;

                            } else {
                                echo "Les deux mots de passe ne sont pas identiques";
                            }

                        } else {
                            echo "Votre session de changement de mot de passe est expiree ou invalide ! Contactez un admin.";
                        }

                    } else {
                        echo "Votre session de changement de mot de passe est expiree ou invalide ! Contactez un admin.";
                    }

                }
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>