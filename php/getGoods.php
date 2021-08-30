<?php
require('setupDB.php');


$user = $_SESSION["userID"];

$conn = mysqli_connect("mysql03.manitu.net", "u69829", "WnMshT5uZdjptdg9", "db69829");
$result = mysqli_query($conn, "SELECT id, name, price, description FROM articles");
//$pics = mysqli_query($conn, "SELECT pic FROM articles");

$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}

echo json_encode($data);
exit();

