<!DOCTYPE html>
<html>
<body>

<?php

$servername = "mysql-champicorp.alwaysdata.net";
$username = "332176_noa";
$password = "dsfgksjdho6154++*fs";

try {

  $conn = new PDO("mysql:host=$servername;dbname=champicorp_data", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected successfully";

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

</body>
</html>