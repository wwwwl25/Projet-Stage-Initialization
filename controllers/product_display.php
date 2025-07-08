<?php
require_once '../Connect.php';
function product_display($dbName)
{
    $connect = new Connect();
    $db = $connect->conn;

    $sql = "SELECT * FROM $dbName";
    $result = mysqli_query($db, $sql);
    return $result;

}
?>