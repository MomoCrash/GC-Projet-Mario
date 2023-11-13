<!DOCTYPE html>
<html lang="en">
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
<a class="nav-link " href="quiz.html" style="color: white;">quiz</a>
</li>
<li class="nav-item">
<a class="nav-link active" href="login.html" style="color: white; background-color: rgba(195, 0, 255, 0.329);">connexion</a>
</li>
<li class="nav-item">
<a class="nav-link" href="https://www.nintendo.fr/Rechercher/Rechercher-299117.html?q=Mario%20Bros&f=147394-5-2-3-1-32-43" style="color: white;">Acheter</a>
</li>
</ul>    

<div class="vertical-center">
<div class="container h-100">

<div class="row d-flex justify-content-center">

<div class="md-6 align-self-center">
<div class="card text-center" style="width: 20rem; height: 30rem; max-height: 50rem;">
<div class="card-header">
<h5 id="question-title" class="card-title">Se connecter</h5>
<h6 id="question-subtitle" class="card-subtitle mb-2 text-body-secondary">Pas de compte ? Creer en un.</h6>
</div>
<div class="card-body">
<form action="/php/login.php" method="post">
<div class="form-group">
<label for="exampleInputEmail1">Adresse email</label>
<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre email">
<small id="emailHelp" class="form-text text-muted">Ne divulgez jamais votre email.</small>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Mot de passe</label>
<input type="password" class="form-control" id="exampleInputPassword1" placeholder="········">
</div>
<button type="submit" class="btn btn-primary">Connexion</button>
</form>
</div>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/action.js"></script> 

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  
  $conn = new PDO("mysql:host=$servername;dbname=champicorp", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  echo "Connected successfully";
  
  $stmt =  $conn->prepare("SELECT score FROM scores ORDER BY score DESC;");
  $stmt->execute();
  //nombre de lignes retournées
  echo "<p>rows ".$stmt->rowCount()."</p>";
  //affichage d’une colonne ligne par ligne
  while ($row = $stmt->fetch()) {
    echo $row['score'] . "<br>";
  }
  
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

</body>
</html>