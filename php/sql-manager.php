<?php

$bdd_servername = "mysql-champicorp.alwaysdata.net";
$bdd_username = "332176_ethan";
$bdd_password = "KOPGSdkgop55+";

try {
    
    $conn = new PDO("mysql:host=$bdd_servername;dbname=champicorp_data", $bdd_username, $bdd_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>