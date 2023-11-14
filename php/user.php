<!DOCTYPE html>
<html>
<body>

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