<!DOCTYPE html>
<html lang="en">

<?php

include "php/sql-manager.php";

session_start();
$name = $_SESSION['name'];
$admin = $_SESSION['admin'];

$isAdmin = false;
if (isset($admin)) {
    if ($admin == 1) {
        $isAdmin = true;
    }
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
<a class="nav-link" href="login.php" style="color: white;">connexion</a>
</li>

<?php

if ($isAdmin) {
    echo '<li class="nav-item">
    <a class="nav-link active" href="editor.php" style="color: white; background-color: rgba(195, 0, 255, 0.329);">editor</a>
    </li>';
}

?>

</ul>    

<div class="vertical-center">
<div class="container h-100">
<div class="row d-flex justify-content-center">             
<?php

function array_to_bdd($array) {

    $textArray = explode(";", $array);

    if (count($textArray) > 1) {
        $formatedBddArray = '[\"' . $textArray[0] . '\",\"';
        for($i=1; $i<count($textArray) - 1; $i++){
            $formatedBddArray .= $textArray[$i] . '\",\"';
        }
        $formatedBddArray .= end($textArray) . '\"]';
    } else {
        $formatedBddArray = '[\"' . $textArray[0] . '\"]';
    }

    return $formatedBddArray;

}

if (isset($admin) && $admin == 1) {

    echo '<form action="editor.php"  method="get">
            <div class="form-group card text-center md-6 align-self-center" style="width:20rem;height: 15rem;margin: 10px;">
                <label style="color:black;" for="recherche">Chercher une question</label>
                <input type="search" class="form-control" id="searchInput" aria-describedby="searchDetail" placeholder="Votre recherche" name="search">
                <small style="color:black;" id="searchDetail" class="form-text">Entrer un mot contenu dans la question.</small>
                <button type="submit" class="btn btn-primary" style="background-color: green;">Rechercher !</button>
                <button type="submit" class="btn btn-primary" style="background-color: red;">Supprimer le filtre</button>
            </div>
          </form>';

    if (isset($_GET["search"])) {

        if ($_GET["search"] != "") {

            $searchParameter = $_GET["search"];
        
        }
    
    }

    echo '<div class="md-6 align-self-center">  
        <form id="qst-form-add"  method="post"> 
        <div class="card text-center" style="width: 20rem; height: 30rem; max-height: 50rem; margin: 10px;">
        <div class="card-header">
        <h5 id="qst-title" class="card-title"> Ajouter une question </h5>
        <textarea id="qst-title-add" class="card-subtitle mb-2 text-body-secondary" style="readonly=false;" name="qst text add"></textarea>
        </div>
        <div class="card-body">
        <label for="qst-anwser-add">Reponses</label>
        <textarea id="qst-valid-anwser-add" class="card-subtitle mb-2 text-body-secondary" style="readonly=false;" name="qst anwsers add"></textarea>
        
        <label for="qst-valid-anwser-add">Index des reponses correctes</label>
        <textarea id="qst-valid-anwser-add" class="card-subtitle mb-2 text-body-secondary" style="readonly=false;" name="qst valid anwsers add"></textarea>
        
        <button name="add" type="submit" id="connection-button" class="btn btn-primary" style="background-color: green;">Ajouter !</button>
        </div>
        <div class="card-footer text-body-secondary">
        <text id="qst-anwser-add" class="card-subtitle mb-2 text-body-secondary" style="readonly=false;" name="qst creator"> Createur : ' . $_SESSION['name'] . ' </text>
        <input type="hidden" name="id" value="' . $_SESSION['id'] . '" />
        </div>
        </div>
        </form>
        </div>';
    
    if (isset($searchParameter)) {
        $request =  $conn->prepare("SELECT * FROM quiz JOIN users ON users.user_id = quiz.user_id WHERE question LIKE '%" . $searchParameter . "%' ORDER BY quiz.question_id");
    } else {
        $request =  $conn->prepare("SELECT * FROM quiz JOIN users ON users.user_id = quiz.user_id ORDER BY quiz.question_id");
    }
    $request->execute();
    
    while ($row = $request->fetch()) {
        echo '<div class="md-6 align-self-center">  
        <form id="qst-form-' . $row["question_id"] . '"  method="post"> 
        <div class="card text-center" style="width: 20rem; height: 30rem; max-height: 50rem; margin: 10px;">
        <div class="card-header">
        <h5 id="qst-title" class="card-title"> Question: N ' . $row["question_id"] . ' </h5>
        <textarea id="qst-title-' . $row["question_id"] . '" class="card-subtitle mb-2 text-body-secondary" style="readonly=false;" name="qst text '  . $row["question_id"] . '">'  . $row["question"] . '</textarea>
        </div>
        <div class="card-body">
        <label for="qst-anwser-' . $row["question_id"] . '">Reponses</label>
        <textarea id="qst-valid-anwser-' . $row["question_id"] . '" class="card-subtitle mb-2 text-body-secondary" style="readonly=false;" name="qst anwsers '  . $row["question_id"] . '">'  . implode(";", json_decode($row["anwsers"])) . '</textarea>
        
        <label for="qst-valid-anwser-' . $row["question_id"] . '">Index des reponses correctes</label>
        <textarea id="qst-valid-anwser-' . $row["question_id"] . '" class="card-subtitle mb-2 text-body-secondary" style="readonly=false;" name="qst valid anwsers '  . $row["question_id"] . '">'  . implode(";", json_decode($row["valid_anwsers"])) . '</textarea>
        
        <button name="save" type="submit" id="connection-button" class="btn btn-primary" style="background-color: green;">Sauvegarder</button>
        <button name="remove" id="connection-button" class="btn btn-primary" style="background-color: red;">Supprimer</button>
        </div>
        <div class="card-footer text-body-secondary">
        <text id="qst-anwser-' . $row["question_id"] . '" class="card-subtitle mb-2 text-body-secondary" style="readonly=false;" name="qst creator"> Createur : '  . $row["name"] . ' </text>
        <input type="hidden" name="id" value="' . $row["question_id"]  . '" />
        </div>
        </div>
        </form>
        </div>';
    }   

    if (isset($_POST["add"])) {

        $formatedAnwser = array_to_bdd($_POST["qst_anwsers_add"]);

        $formatedValidAnwser = array_to_bdd($_POST["qst_valid_anwsers_add"]);

        $request =  $conn->prepare("INSERT INTO quiz (`question_id`, `question_type`, `question`, `anwsers`, `valid_anwsers`, `user_id`) 
        VALUES (NULL, 'qcm', '" . $_POST["qst_text_add"] . "', '" . $formatedAnwser . "', '" . $formatedValidAnwser . "', '" . $_POST["id"] . "');");
        $request->execute();
        echo "<meta http-equiv='refresh' content='0'>";


    }

    if (isset($_POST["remove"])) {
        
        $id = $_POST["id"];
        $request =  $conn->prepare("DELETE FROM quiz WHERE question_id=" . $id);
        $request->execute();

        echo "<meta http-equiv='refresh' content='0'>";

    }

    if (isset($_POST["save"])) {

        $id = $_POST["id"];

        $formatedAnwser = array_to_bdd($_POST["qst_anwsers_". $id]);
        $formatedValidAnwser = array_to_bdd($_POST["qst_valid_anwsers_". $id]);

        $request =  $conn->prepare("UPDATE quiz SET question='" . $_POST["qst_text_". $id] . "', anwsers='" . $formatedAnwser . "', valid_anwsers='" . $formatedValidAnwser . "' WHERE question_id=" . $id . ";");
        $request->execute();
        echo "<meta http-equiv='refresh' content='0'>";

    }
    
}

?>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>