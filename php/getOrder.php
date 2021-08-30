<?php
require('setupDB.php');


$user = $_SESSION["userID"];
$name = $_SESSION["nachname"];

$conn = mysqli_connect("mysql03.manitu.net", "u69829", "WnMshT5uZdjptdg9", "db69829");
$result = mysqli_query($conn, "SELECT * FROM orders WHERE userId = '$user'");

$data = array();

while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}


$sql= "SELECT * FROM articles";
    $res = $conn -> query($sql);
    while( $row = $res->fetch_array()){
    $articleName = $row['name'];
    $articlePrice = $row['price'];
    array_push($data, $articleName);
    array_push($data, $articlePrice);
   }
   
   
   if($firstname){
    array_push($data, $name);
}
  



echo json_encode($data);

exit();