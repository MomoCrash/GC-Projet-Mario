<?php

include "php/sql-manager.php"; 

echo $_POST["newScore"];
$_POST["id"]

//todo insert sql du new score (penser à utiliser bindParam pour mettre les paramètres sql)

$_POST = $conn->prepare("INSERT INTO scores (score, user_id) VALUES (5644, 0)"); 

$bestScores = $conn->prepare("SELECT name, score FROM scores JOIN users ON scores.user_id = users.user_id ORDER BY score DESC LIMIT 10;");
    $bestScores->execute();

    $arrayScore = [];

    while ($row = $bestScores->fetch()) {
      array_push($arrayScore, $row);
    }

echo htmlspecialchars(json_encode($arrayScore)) 

?>