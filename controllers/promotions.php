<?php
require '../Connect.php';
$db = new Connect();
$conn = $db->conn;

function get_promotion($conn, $tableName){
$query = "SELECT * FROM $tableName WHERE promotion IS NOT NULL AND promotion <> ''";

$result = mysqli_fetch_all(mysqli_query($conn, $query), MYSQLI_ASSOC);

return [$result, $tableName];
}

$promotions = array(
    get_promotion($conn, 'bio'),
    get_promotion($conn, 'vitamines'),
    get_promotion($conn, 'serums'),
    get_promotion($conn, 'maquillage')
);
