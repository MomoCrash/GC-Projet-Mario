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
          <div class="card text-center" style="width: 20rem; height: 35rem; max-height: 50rem;">
            <div class="card-header">
              <h5 id="question-title" class="card-title">Se connecter</h5>
            </div>
            <div class="card-body">
              <form action="login.php?method=<?= $currentMethod ?>" method="post">

                  <?php 

                      if ($currentMethod == "register") {
                          echo "<div class='form-group'>
                            <label for='nameInput'>Nom d'utilisateur</label>
                            <input type='text' class='form-control' id='nameInput' placeholder='Jeromenimo' name='username' maxlength='10'>
                            </div>";
                      }
                  ?>
                  <div class="form-group">
                    <label for="emailInput">Adresse email</label>
                    <input type="email" class="form-control" id="emailInput" aria-describedby="emailDetail" placeholder="Votre email" name="email">
                    <small id="emailDetail" class="form-text text-muted">Ne divulgez jamais votre email.</small>
                  </div>
                  <div class="form-group">
                    <label for="passwordInput">Mot de passe</label>
                    <input type="password" class="form-control" id="passwordInput" placeholder="········" name="password">
                  </div>
                  <p class="text-center"> <a href='recovery.php'>Mot de passe oublie</a></p>
                  <button style="background-color: green;" type="submit" name="<?= $currentMethod ?>" id="<?= $currentMethod ?>" class="btn btn-primary"><?php if ($currentMethod == "login") echo 'Connexion'; else echo 'register';  ?> </button>
              </form>
              <?php
                
                if ($currentMethod == "login" && isset($_POST["password"]) && isset($_POST["email"]) && !isset($_POST["username"])) {

                    $password = $_POST["password"]; 
                    $mail = $_POST["email"];

                    $request =  $conn->prepare("SELECT * FROM users WHERE mail='" . $mail . "';");
                    $request->execute();
                    //nombre de lignes retournées
                    $count = $request->rowCount();
                    $currentRow  = $request -> fetch();

                    if (password_verify($password, $currentRow['password'])) {
                      if ($count > 0) {
                        echo "Vous etes connecte";
                        $_SESSION['name'] = $currentRow['name'];
                        $_SESSION['admin'] = $currentRow['admin'];
                        $_SESSION['id'] = $currentRow["user_id"];
                        header('Location: quiz.php');
                        exit;
                      } else {
                        echo "Identifiants inccorectes.";
                      }
                    } else {
                      echo "Identifiants inccorectes.";
                    }

                }

                if ($currentMethod == "register") {

                  if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"])) {

                    $mail = $_POST["email"];
                    $username = $_POST["username"];

                    $mail = refracto_text($mail);
                    $username = refracto_text($username);

                    $request =  $conn->prepare("SELECT mail FROM users WHERE mail='" . $mail . "';");
                    $request->execute();
                    //nombre de lignes retournées
                    $count = $request->rowCount();

                    if ($count > 0) {
                      
                      echo 'Cet utilisateur exite deja !';

                    } else {

                      $mail = refracto_text($mail);
                      $username = refracto_text($username);
                      $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                      $request =  $conn->prepare("INSERT INTO `users` (`user_id`, `mail`, `name`, `password`, `admin`) VALUES (NULL, '". $mail ."', '" . $username . "', '" . $password . "', 0);");
                      $request->execute();

                      $response =  $conn->prepare("SELECT * FROM users WHERE mail='" . $mail . "';");
                      $response -> execute();

                      $currentRow  = $response -> fetch();

                      $_SESSION['name'] = $currentRow['name'];
                      $_SESSION['admin'] = $currentRow['admin'];
                      $_SESSION['id'] = $currentRow["user_id"];
                      
                      header('Location: quiz.php');
                      exit;

                    }

                  }
                  
                } 

              ?>
            </div>
            <div class="card-footer">
              <?php 
                if ($opositeMethod == "login")
                  $methodText = "Se connecter";
                else {
                  $methodText = "S'enregister";
                }
                echo '<a class="card-title" href="login.php?method=' . $opositeMethod . '" style="color: black;">' . $methodText . '</a>' 
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