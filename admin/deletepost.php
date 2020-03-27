<?php include "inc/functions.php"; ?>






<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(isset($_POST['deletepost'])) {

		$id = filter_input(INPUT_POST,'id' , FILTER_SANITIZE_NUMBER_INT);

		if( delete('posts' , $id) ) {
			if (! session_id()){
        			session_start();
        		}
	    $_SESSION['success'] = "Post has delete Successfully";
			redirect('posts.php');
		}
	}
}

?>