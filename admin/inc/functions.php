<?php

function get_categories($id = "") {
    include "connect.php";
    $sql = "";
   if(empty($id)){
     $sql = "SELECT * FROM categories";
   }else {
     $sql = "SELECT * FROM categories WHERE id = ?";
   }
    try {
      if(empty($id)){
        $result = $con->query($sql);
        return $result;
      }else {
        $result = $con->prepare($sql);
        $result->bindValue(1,$id,PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
      }
    }
    catch(Exception $e) {
        echo  "Error: " .$e->getMessage();
                return array();

      }
    }
function insert_category($datetime,$name,$creater_name) {
$fields = array($datetime,$name,$creater_name);
include "connect.php";
$sql = "INSERT INTO categories (datetime, name, creater_name) VALUES (?,?,?)";
 try{
       $result = $con->prepare($sql);

       for($i = 1; $i <= 3; $i++){
           $result->bindValue($i, $fields[$i - 1], PDO::PARAM_STR);
       }
       return $result->execute();
   }catch(Exception $e) {
       echo "Error: ". $e->getMessage();
       return false;
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




function get_posts($id = "") {
    include "connect.php";
    $sql = "";
    if(empty($id)){
    $sql = "SELECT * FROM posts ORDER BY datetime ASC";
    }else {
     $sql = "SELECT * FROM posts WHERE id = ?";
    }


    try {
      if(! empty($id)) {
      $result = $con->prepare($sql);
      $result->bindValue(1, $id, PDO::PARAM_INT);
      $result->execute();

      return $result->fetch(PDO::FETCH_ASSOC);
      }else {
        $result = $con->query($sql);
        return $result;
      }
        
    }
    catch(Exception $e) {
        echo  "Error: " .$e->getMessage();
        return array();
    }
}




function delete($table, $id) {
  include "connect.php";
  $sql = "DELETE FROM $table WHERE id = ? ";
  try{
    $result = $con->prepare($sql);
    $result->bindValue(1, $id, PDO::PARAM_INT);

    return $result->execute();
  }
  catch(Exception $e) {
    echo "Error: " . $e->getMessage();
    return false;
  }
}




  function update_post($title, $content, $excerpt, $image = "", $category, $tags, $id) {
  $fields = array($title, $content, $excerpt, $category, $tags);
  include "connect.php";
  $sql = "";

  if(empty($image)) {
   $sql = "UPDATE posts SET title = ?, content = ?, excerpt = ?, category = ?, tags = ? WHERE id = ?";
  }else {
  $sql = "UPDATE posts SET title = ?, content = ?, excerpt = ?,  category = ?, tags = ? image = ?, WHERE id = ?";
}
  try {



    $result = $con->prepare($sql);
 
       for($i = 1; $i <= 5; $i++){
           $result->bindValue($i, $fields[$i - 1], PDO::PARAM_STR);
       }
           if(! empty($image)) {
            $result->bindValue(6, $image, PDO::PARAM_STR);
            $result->bindValue(7,$id,PDO::PARAM_INT);
           }else{
            $result->bindValue(6,$id,PDO::PARAM_INT);
               }

      return $result->execute();
  }catch(Exception $e) {
    echo "Error: " .$e->getMessage();
    return false;
  }
}




//insert admin


function insert_admin($datetime,$username,$email,$password,$role_type,$created_by,$img_name) {
   $fields = array($datetime,$username,$email,$password,$role_type,$created_by,$img_name);
   include "connect.php";
   $sql = "INSERT INTO admins (datetime, username, email, password, roletype, created_by, image) VALUES
(?,?,?,?,?,?,?) ";

   try{
       $result = $con->prepare($sql);

       for($i = 1; $i <= 7; $i++){
           $result->bindValue($i, $fields[$i - 1], PDO::PARAM_STR);
       }
       return $result->execute();
   }catch(Exception $e) {
       echo "Error: ". $e->getMessage();
       return false;
   }
}













function get_admins($id = "") {
    include "connect.php";
    $sql = "";
    if(empty($id)){
    $sql = "SELECT * FROM admins ORDER BY datetime ASC";
    }else {
     $sql = "SELECT * FROM admins WHERE id = ?";
    }


    try {
      if(! empty($id)) {
      $result = $con->prepare($sql);
      $result->bindValue(1, $id, PDO::PARAM_INT);
      $result->execute();

      return $result->fetch(PDO::FETCH_ASSOC);
      }else {
        $result = $con->query($sql);
        return $result;
      }
        
    }
    catch(Exception $e) {
        echo  "Error: " .$e->getMessage();
        return array();
    }
}




function is_admin($email) {

  include "connect.php";
  $sql = "SELECT id, email, username, password FROM admins WHERE email = ? ";
  try {

    $result = $con->prepare($sql);
    $result->bindValue(1, $email, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch(PDO::FETCH_ASSOC);
  }
  catch(Exception $e) {
    echo "Error: ". $e->getMessage();
  }
}



function update_reset_password_code($email) {

  include "connect.php";
  $newcode = rand(10000, 99999);
  $sql = "UPDATE admins SET reset_password_code = $newcode WHERE email = ? ";
  try {
    $result = $con->prepare($sql);
    $result->bindValue(1, $email, PDO::PARAM_STR);
    return $result->execute();
  }catch(Exception $e) {
    echo "Error: " .$e->getMessage();
    return false;
  }

}






//Comment function 

function get_comments($id = "") {
    include "connect.php";
    $sql = "";
    if(empty($id)){
    $sql = "SELECT * FROM commentss ORDER BY datetime ASC";
    }else {
     $sql = "SELECT * FROM commentss WHERE id = ?";
    }


    try {
      if(! empty($id)) {
      $result = $con->prepare($sql);
      $result->bindValue(1, $id, PDO::PARAM_INT);
      $result->execute();

      return $result->fetch(PDO::FETCH_ASSOC);
      }else {
        $result = $con->query($sql);
        return $result;
      }
        
    }
    catch(Exception $e) {
        echo  "Error: " .$e->getMessage();
        return array();
    }
}







function insert_comment($datetime, $username, $email, $comment, $post_id) {
  $fields = array($datetime, $username, $email, $comment);
   include "connect.php";
   $sql = "INSERT INTO commentss (datetime, commenter_name, commenter_email, comment, post_id) VALUES
(?,?,?,?,?) ";

   try{
       $result = $con->prepare($sql);

       for($i = 1; $i <= 4; $i++){
           $result->bindValue($i, $fields[$i - 1], PDO::PARAM_STR);
       }
       $result->bindValue(5, $post_id, PDO::PARAM_INT);
       return $result->execute();
   }catch(Exception $e) {
       echo "Error: ". $e->getMessage();
       return false;
   }
}


// Settings Function


function get_settings() {
  include "connect.php";
  $sql = "SELECT * FROM settings";
  try {
    $result = $con->query($sql);
    return $result;
  }
  catch(Exception $e) {
    echo "Error: ".$e->getMessage();
    return array();
  }
}












function redirect($location) {
      header("Location: $location");
}

 ?>


