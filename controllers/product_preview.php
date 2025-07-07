<?php
require 'Connect.php';
$db = new Connect();
$conn = $db->conn;
function preview($tableName, $conn){
    $query = "SELECT id, name, description, prix, photo FROM $tableName";
    $result = mysqli_query($conn, $query);
    $r = [];

    while($f_r = mysqli_fetch_assoc($result)){
        array_push($r, [$tableName, $f_r]);
    }
    return $r;
}
function dd($var)
{
    echo "<pre>";

    var_dump($var);
    echo "</pre>";
    die();
}
$serum = preview("serums", $conn);

$vita = preview("vitamines", $conn);
$makeup = preview("maquillage", $conn);
$bio = preview("bio", $conn);

$products = array($serum[rand(0, count($serum)-1)], $vita[rand(0, count($vita)-1)], $makeup[rand(0, count($makeup)-1)], $bio[rand(0, count($bio)-1)]);
