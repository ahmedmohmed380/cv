<?php include "inc/functions.php"; ?>


<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(isset($_POST['deletecategory'])) {

		$id = filter_input(INPUT_POST,'id' , FILTER_SANITIZE_NUMBER_INT);

		if( delete('categories' , $id) ) {
			if (! session_id()){
        			session_start();
        		}
	    $_SESSION['success'] = "category has delete Successfully";
			redirect("categories.php");
		}else {
			 $_SESSION['error'] = "unable to delete Successfully";
			redirect("categories.php");
		}
	}
}

?>