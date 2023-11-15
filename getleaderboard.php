<?php

include "php/sql-manager.php"; 


//todo insert sql du new score (penser à utiliser bindParam pour mettre les paramètres sql)

$newScore = $conn->prepare("INSERT INTO scores (score, user_id) VALUES (:newScore,:id)"); 
$newScore->bindParam(':newscore',$_POST["newScore"], PDO::PARAM_INT);
$newScore->bindParam(':newId',$_POST["id"], PDO::PARAM_INT);
$newScore->execute();

$bestScores = $conn->prepare("SELECT name, score FROM scores JOIN users ON scores.user_id = users.user_id ORDER BY score DESC LIMIT 10;");
$bestScores->execute();

$arrayScore = [];

while ($row = $bestScores->fetch()) {
    array_push($arrayScore, $row);
}

echo '<div class="bestScores" data-service="<?= htmlspecialchars(json_encode($arrayScore)) ?>">'

?>