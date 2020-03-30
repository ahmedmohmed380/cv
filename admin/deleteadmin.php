<?php include "inc/functions.php"; ?>






<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(isset($_POST['deleteadmin'])) {

		$id = filter_input(INPUT_POST,'id' , FILTER_SANITIZE_NUMBER_INT);

		if( delete('admins' , $id) ) {
			if (! session_id()){
        			session_start();
        		}
	    $_SESSION['success'] = "Admin has delete Successfully";
			redirect('admins.php');
		}
	}
}

?>