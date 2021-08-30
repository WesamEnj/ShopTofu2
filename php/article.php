<?php

require('setupDB.php');




if (isset($_POST['add'])){
  
    $pArticleName = $conn -> real_escape_string($_POST["articleName"]);  
    $pArticlePrice_ = $conn -> real_escape_string($_POST["articlePrice"]);
    $pArticlePrice = substr($pArticlePrice_, 4);
    $pArticleDescription = $conn -> real_escape_string($_POST["articleDescription"]);
    
    $pArticleImageData = addslashes(file_get_contents($_FILES['articleImage']['tmp_name']));

    $sql = 'SELECT * FROM articles WHERE name = "'.$pArticleName.'"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $error = "This tofu is already in the system";
        echo $error;
  } else{
    
    $sql= "SELECT id FROM articles ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $lastId = $row['id']+1;
   
    $sql = insertArticle($lastId, $conn, $pArticleName, $pArticlePrice, $pArticleDescription, $pArticleImageData);
    }
}


function insertArticle($id, $connection, $name, $price, $description, $img){

$ins = "INSERT INTO articles (id, name, price, description, pic) VALUES  ($id, '$name', '$price', '$description', '{$img}')";



if ($connection->query($ins) === TRUE) {
    echo "New article added successfully";
  } else {
    echo "Error: " . $ins . "<br>" . $connection->error;
  }

  echo "<script type='text/javascript'>alert('Tofu ist drin');
            window.location='../html/index.php';
            </script>";
}



// close the connection

?> 