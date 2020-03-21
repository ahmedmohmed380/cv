<?php

function get_categories() {
    include "connect.php";
    $sql = "select * from categories";
    try {
        $result = $con->query($sql);
        return $result;
    }
    catch(Exception $e) {
        echo  "Error: " .$e->getMessage();
                return array();

    }
}


//Post Function

function insert_post($datetime, $title, $content, $author,  $excerpt, $image, $category, $tags) {
   $fields = array($datetime, $title, $content, $author, $excerpt, $image, $category, $tags);
   include "connect.php";
   $sql = "INSERT INTO posts (datetime, title, content, author, excerpt, image, category, tags) VALUES
(?,?,?,?,?,?,?,?) ";

   try{
       $result = $con->prepare($sql);

       for($i = 1; $i <= 8; $i++){
           $result->bindValue($i, $fields[$i - 1], PDO::PARAM_STR);
       }
       return $result->execute();
   }catch(Exception $e) {
       echo "Error: ". $e->getMessage();
       return false;
   }
}




function get_posts() {
    include "connect.php";
    $sql = "select * from posts";
    try {
        $result = $con->query($sql);
        return $result;
    }
    catch(Exception $e) {
        echo  "Error: " .$e->getMessage();
        return array();
    }
}
 ?>


