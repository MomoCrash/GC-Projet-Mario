<?php

include "php/sql-manager.php"; 

session_start();

//todo insert sql du new score (penser à utiliser bindParam pour mettre les paramètres sql)

$usersScores = $conn->prepare("SELECT * FROM scores WHERE user_id=:newId"); 
$usersScores->bindParam(':newId',$_SESSION["id"], PDO::PARAM_INT);
$usersScores->execute();

$count = $usersScores->rowCount();

if ($count > 0) {
 $oldScore = $usersScores -> fetch();
 if ($_POST["newScore"] > $oldScore["score"]) {

    $usersScores = $conn->prepare("UPDATE scores SET score=:newScore WHERE user_id=:id"); 
    $usersScores->bindParam(':newScore', $_POST["newScore"], PDO::PARAM_INT);
    $usersScores->bindParam(':id', $_SESSION["id"], PDO::PARAM_INT);
    $usersScores->execute();

 }
} else {

    $newScore = $conn->prepare("INSERT INTO scores (score, user_id) VALUES (:newScore,:newId)"); 
    $newScore->bindParam(':newScore',$_POST["newScore"], PDO::PARAM_INT);
    $newScore->bindParam(':newId',$_SESSION["id"], PDO::PARAM_INT);
    $newScore->execute();

}

$bestScores = $conn->prepare("SELECT name, score FROM scores JOIN users ON scores.user_id = users.user_id ORDER BY score DESC LIMIT 10;");
$bestScores->execute();

$arrayScore = [];

while ($row = $bestScores->fetch()) {
    array_push($arrayScore, $row);
}

echo json_encode($arrayScore);

?>