<!DOCTYPE html>
<html lang="en">

<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
  
  $conn = new PDO("mysql:host=$servername;dbname=champicorp", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  echo "Connected successfully";
  
  $stmt =  $conn->prepare("SELECT * FROM users WHERE mail='ethan.gilotin@gmail.com' AND password='xxx';");
  $stmt->execute();
  //nombre de lignes retournées
  echo "<p>rows ".$stmt->rowCount()."</p>";
  //affichage d’une colonne ligne par ligne
  while ($row = $stmt->fetch()) {
    echo $row['name'] . "<br>";
  }
  
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

</body>
</html>