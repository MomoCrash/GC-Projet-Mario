<!DOCTYPE html>
<html>
<body>
<h1> heeeello </h1>
<?php

include 'user.php';

try {

  // PAs Maintenant
  //$score = 2;
  //$user_id = 0;
    
    // Sécurité
    /*$bestScores = $conn->prepare("INSERT INTO scores(score_id, score, user_id) VALUES(NULL, :score, :user_id)");
    $bestScores->bindParam(':score',$score , PDO::PARAM_INT);
    $bestScores->bindParam(':user_id',$user_id , PDO::PARAM_INT);

    $bestScores->execute();*/

    $bestScores = $conn->prepare("SELECT name, score FROM scores JOIN users ON scores.user_id = users.user_id ORDER BY score DESC LIMIT 10;");
    $bestScores->execute();
    
    //nombre de lignes retournées
    echo "<p>rows ".$bestScores->rowCount()."</p>";
    //affichage d’une colonne ligne par ligne
    while ($row = $bestScores->fetch()) {
      echo $row['name'].$row['score'] . "<br>";
    }
   
  } catch(PDOException $e) {
    echo "insert  failed: " . $e->getMessage();
  }

?>
</body>
</html>