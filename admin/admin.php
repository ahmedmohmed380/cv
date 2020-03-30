<?php 
include "inc/header.php";
include "inc/navbar.php";
include "inc/functions.php";
include "inc/connect.php";

?>


<?php


    $username = "";
	$email = "";
	$password = "";
	$roletype = "";
	$created_by = "";





if($_SERVER['REQUEST_METHOD']  === 'POST') {
	if(isset($_POST['addadmin'])) {


		$username = filter_input(INPUT_POST, 'username' , FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_STRING);
		$roletype = filter_input(INPUT_POST, 'roletype' , FILTER_SANITIZE_STRING);
		

        $created_by = "mohammed"; //Temprary Author until creating admins

        date_default_timezone_set("Asia/Riyadh");
        $datetime = date( 'M-D-Y h:m', time());

        $password = password_hash('11111111', PASSWORD_DEFAULT);

           
		$image = $_FILES['image'];


		$img_name = $image['name'];
		$img_tmp_name = $image['tmp_name'];
		$img_size = $image['size'];


		$error_msg = "";
		if(strlen($username) < 5 || strlen($username) > 30) {
			$error_msg = "Username must be between 5 and 30 Characters";
		}else if(strlen($email) < 10 || strlen($email) > 100) {
			$error_msg = "Email must be between 10 and 100 Characters";
		}else {

			if(! empty($img_name)) {
				$img_extension = strtolower(explode('.', $img_name)[1]);

				$allowed_extensions = array('jpg' , 'png' , 'jpeg');

				If(! in_array($img_extension, $allowed_extensions)) {
					$error_msg = "Allowed Extensions are jpg, png and jpeg ";
				}else if ( $img_size > 9000000) {
					$error_msg = "Image size must be less than 9M";
				}
			}
		}


        if(empty($error_msg)) {
            if (! session_id()){
                	session_start();
                }







        	// Insert Date in Database
        	if( insert_admin($datetime, $username, $email, $password, $roletype, $created_by, $img_name) ) {

             //send password to admin
        		if(password_verify('11111111', $password)) {
        		$send_password = "11111111";

        		$subject = "Recieve Yor Password";

        		$message = "You have Added in CV wbsit as Admin, Your password is $send_password , yoc can change";

        		mail($email, $subject, $message);

        	}







        		if(! empty($img_name)) {
        			$new_path = "uploads/admins/".$img_name;
        			move_uploaded_file( $img_tmp_name, $new_path);
        		}
        		$_SESSION['success'] = "Admin has added Successfully";
               	redirect("admins.php");
        	}else {
        		$_SESSION['error'] = "Unable to Add Admin";
        		redirect("admins.php");
        	}
        }
	}else {
				if(isset($_POST['updatepost'])){

         $id = filter_input(INPUT_POST,'id' , FILTER_SANITIZE_NUMBER_INT);
         $title = filter_input(INPUT_POST, 'title' , FILTER_SANITIZE_STRING);
		$content = filter_input(INPUT_POST, 'content' , FILTER_SANITIZE_STRING);
		$category = filter_input(INPUT_POST, 'category' , FILTER_SANITIZE_STRING);
		$excerpt = filter_input(INPUT_POST, 'excerpt' , FILTER_SANITIZE_STRING);
		$tags = filter_input(INPUT_POST, 'tags' , FILTER_SANITIZE_STRING);
		$image = $_FILES['image'];


		$img_name = $image['name'];
		$img_tmp_name = $image['tmp_name'];
		$img_size = $image['size'];






$error_msg = "";
		if(strlen($title) < 10 || strlen($title) > 200) {
			$error_msg = "Title must be between 10 and 200";
		}else if(strlen($content) < 10 || strlen($content) > 100000) {
			$error_msg = "Content must be between 100 and 100000";
		}else if(! empty($excerpt)){
			If(strlen($excerpt) < 10 || strlen($excerpt) > 1000) {
			$error_msg = "Excerpt must be between 10 and 1000";
			}
		}else {

			if(! empty($img_name)) {
				$img_extension = strtolower(explode('.', $img_name)[1]);

				$allowed_extensions = array('jpg' , 'png' , 'jpeg');

				If(! in_array($img_extension, $allowed_extensions)) {
					$error_msg = "Allowed Extensions are jpg, png and jpeg ";
				}else if ( $img_size > 9000000) {
					$error_msg = "Image size must be less than 9M";
				}
			}
		}


                if(empty($error_msg)) {
                	$updated = "";

                    
                	if(empty($img_name)) {
                		$updated = update_post($title, $content, $excerpt, $img_name, $category, $tags, $id);
                	}else {
                		$updated = update_post($title, $content, $excerpt, $img_name, $category, $tags, $id);
                	}
        	if($updated) {

        		if (! session_id()){
        			session_start();
        		}
        		if(! empty($img_name)) {
        			$new_path = "uploads/posts/".$img_name;
        			move_uploaded_file( $img_tmp_name, $new_path);
        		}
        		  $_SESSION['success'] = "Post has updated Successfully";
                    redirect("posts.php");
        	}else {
        		echo "Unable to update";
        	}
        }
					
				}
			}
}else if(isset($_GET['id'])){
	$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
	$admin = get_admins($id);

	$username = $admin['username'];
	$email = $admin['email'];
	$roletype = $admin['roletype'];
	
	$roletypes = array("Admin", "Subscriber");



}




 ?>






<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<?php include "inc/sidebar.php"; ?>
		</div>
		<div class="col-sm">
			<div class="admin">
			<?php if(isset($_GET['id'])) { ?>
				<h4>Edit Admin</h4>
			<?php }else {
				echo "<h4>Add New Admin</h4>";
			} ?>
				<form action="admin.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<imput type="hidden" name="id" value="<?php echo $id; ?>">
						<input value="<?php echo $username; ?>" class="form-control" type="text" name="username" placeholder="Username" required autocomplete="off" >
						<p class="error username-error">Username the must be between 5 and 30 characters</p>
					</div>
					<div class="form-group">
						<input value="<?php echo $email; ?>" class="form-control" type="email" name="email" placeholder="Email" required autocomplete="off" >
						<p class="error email-error">Email the must be between 10 and 100 characters</p>
					</div>
					<div class="form-group">
						<select class="form-control" name="roletype">

							
					    	<option value="Admin" >Admin</option>
					    	<option value="Subscriber" >Subscriber</option>
					     
						</select>
					</div>
					
					

                  <?php if(! empty($post['image'])){ ?>
                  	<label>Post Image: </label>
                      <img width="100" src="uploads/posts/<?php echo $post['image'];?>">
                      <?php } ?>



					<div class="form-group">
						<input type="file" name="image" class="form-control">
					</div>

					<?php if(isset($_GET['id'])) { ?>
              <input value="Edit admin" type="submit" name="updateadmin" class="btn btn-primary" style="float: right;">

					 <?php }else { ?>
					<input value="Add Admin" type="submit" name="addadmin" class="btn btn-primary" style="float: right;">
				<?php } ?>
				</form>
			</div>
		</div>
	</div>
</div>










<?php include "inc/footer.php"; ?>