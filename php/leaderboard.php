<!DOCTYPE html>
<html>
<body>
<h1> heeeello </h1>
<?php

include 'user.php';

try {

    $bestScores = $conn->prepare("INSERT INTO scores(score_id, score, user_id) VALUES(NULL, score_id, score, user_id");
    $bestScores->bindParam(':score_id',$score_id , PDO::PARAM_INT);
    $bestScores->bindParam(':score',$score , PDO::PARAM_INT);
    $bestScores->bindParam(':user_id',$user_id , PDO::PARAM_INT);

    $besteScores->execute();
    
    //nombre de lignes retournées
    echo "<p>rows ".$bestScores->rowCount(10)."</p>";
    //affichage d’une colonne ligne par ligne
    while ($row = $bestScores->fetch()) {
      echo $row['score'] . "<br>";
    }
  
  
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

?>
</body>
</html>