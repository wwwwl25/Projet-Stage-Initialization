<?php
require 'Connect.php';
$db = new Connect();
$conn = $db->conn;
function preview($tableName, $conn){
    $query = "SELECT * FROM $tableName";
    $result = mysqli_query($conn, $query);
    $r = [];

    while($f_r = mysqli_fetch_assoc($result)){
        array_push($r, [$tableName, $f_r]);
    }
    return $r;
}

$serum = preview("serums", $conn);

$vita = preview("vitamines", $conn);
$makeup = preview("maquillage", $conn);
$bio = preview("bio", $conn);

$products = array($serum[4], $vita[6], $makeup[5], $bio[1]);
