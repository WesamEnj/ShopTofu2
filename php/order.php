<?php

require('setupDB.php');

$user = $_SESSION["userID"];

$pArticleId = $_POST['id'];



$sql = 'SELECT * FROM articles';
$result = $conn->query($sql);
$index = $result->num_rows; // how many articles do we have right now?

for ($i=1; $i<=$index; $i++){
    
    $article = "article_" . $i;
    
    
    $addArticleColumn= "ALTER TABLE orders ADD COLUMN IF NOT EXISTS $article int(10) NOT NULL DEFAULT '0'";
   

    if ($conn->query($addArticleColumn) === TRUE) {
        echo "article column added" . "<br>";
    }
}

echo insertOrder($conn, 1, 1,1);
//insertOrder($conn, $user, $pArticleId);

if (isset($_POST['addArticle'])){
    insertOrder($conn, $user, $pArticleId, $index);
}
if (isset($_POST['getUserOrders'])){
    getUserOrders($conn, $user);
}

function calcPrice($article, $amount, $connection){
    $totalPrice = 0;
    
    $sql= "SELECT price FROM articles WHERE id = '$article'";
    $res = $connection -> query($sql);
    $row = $res->fetch_assoc();
    
    $totalPrice = $row['price'] * ($amount+1);
    return $totalPrice;

}

function getTotalPrice($userId, $index, $connection){
    $totalPrice = 0;
    for ($i=1; $i<=$index; $i++){

        $article = "article_" . $i;
        $sql= "SELECT $article FROM orders WHERE userId = '$userId'";
        $res = $connection -> query($sql);
        $row = $res->fetch_assoc();

        $amount = $row[$article];
        $price = calcPrice($i, $amount,$connection);
        $totalPrice = $totalPrice + $price;

    }
    return $totalPrice;
}

function insertOrder($connection, $userId, $articleId, $index){
    
                
    $article = "article_" . $articleId;
    $id = 0;

    $sql = 'SELECT * FROM orders WHERE userId = "'.$userId.'"';
    
    $result = $connection->query($sql);
    // user hat noch keinen warenkorb?
    if ($result->num_rows == 0){
        
        
        $articleAmount = 1; //erster Artikel im Warenkorb
        
        $sql= "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        echo "test";
        if($row['id']=1){
            $lastId = 0;
            }
        else{
            $lastId = $row['id']+1;
        }
        
        $price = calcPrice($articleId, 1, $connection);
            
        $ins = "INSERT INTO orders (id, userId, totalPrice, articleAmount, $article) VALUES ($lastId, $userId, $price, $articleAmount, 1)";
        if ($connection->query($ins) === TRUE) {
            echo "New article inserted successfully";
        } else {
            echo "Error: " . $ins . "<br>" . $connection->error;
            }
        }


    else{
        $totalPrice = getTotalPrice($userId, $index, $connection);
        $upd = "UPDATE orders SET articleAmount = articleAmount+1 , $article = $article+1, totalPrice = $totalPrice WHERE userId = '$userId'";

            if ($connection->query($upd) === TRUE) {
                echo "Order updated successfully";
            } else {
                echo "Error updating order: " . $connection->error;
            }   
        }

}
       
function getUserOrders($connection, $userId ){
    $sql = 'SELECT * FROM orders WHERE userId = "'.$userId.'"';
    $res = $connection -> query($sql);
    if (!$res) {
        die("Select fehlgeschlagen: " . $connection -> connect_error);}
    else {
        $order = array();
        while ( $row = $res->fetch_assoc())  {
            $order[]=$row;
          }
          //echo json_encode($order);
    }

}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }





// close the connection

?> 