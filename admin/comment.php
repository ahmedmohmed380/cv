<?php 
include "inc/header.php";
include "inc/navbar.php";
include "inc/functions.php";
?>


<?php


    $id = "";
if(! session_id()) {
	session_start();
}

	$username = $_SESSION['admin_username'];
	$email = $_SESSION['admin_email'];
	$comment = "";





if($_SERVER['REQUEST_METHOD']  === 'POST') {
	if(isset($_POST['addcomment'])) {


		$username = filter_input(INPUT_POST, 'username' , FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_STRING);
		$comment_comment = filter_input(INPUT_POST, 'comment' , FILTER_SANITIZE_STRING);
		$post_id = filter_input(INPUT_POST, 'post_id' , FILTER_SANITIZE_STRING);

        $author = "mohammed"; //Temprary Author until creating admins

        date_default_timezone_set("Asia/Riyadh");
        $datetime = date( 'M-D-Y h:m', time());

       

		$error_msg = "";
		if(strlen($comment) < 10 || strlen($comment) > 500) {
			$error_msg = "comment must be between 10 and 500";
		}else 


        if(empty($error_msg)) {
            if (! session_id()){
                	session_start();
                }







        	// Insert Date in Database
        	if( insert_comment($datetime, $username, $email, $comment, $post_id) ) {
        		
        		$_SESSION['success'] = "comments has added Successfully";
               	redirect("comments.php");
        	}else {
        		echo "Unable to Add";
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
		}else if(strlen($content) < 100 || strlen($content) > 100000) {
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
	$post = get_posts($id);

	$title = $post['title'];
	$content = $post['content'];
	$category_name = $post['category'];
	$excerpt = $post['excerpt'];
	$tags = $post['tags'];
	



}







 ?>






<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<?php include "inc/sidebar.php"; ?>
		</div>
		<div class="col-sm">
			<div class="post">
			<?php if(isset($_GET['id'])) { ?>
				<h4>Edit Comment</h4>
			<?php }else {
				echo "<h4>Add New Comment</h4>";
			} ?>
				<form action="comment.php" method="POST">
					<div class="form-group">
						<imput type="hidden" name="id" value="<?php echo $id; ?>">
						<input readonly value="<?php echo $username; ?>" class="form-control" type="text" name="username">
					</div>
					<div class="form-group">
						<input readonly value="<?php echo $email; ?>" class="form-control" type="email" name="email">
					</div>
					<div class="form-group">
						<textarea required placeholder="Comment" autocomplete="off" rows="6" name="comment" class="form-control"><?php echo $comment; ?></textarea>
							<p class="error content-error">Comment the must be between 5 and 10000 characters</p>
					</div>
					<div class="form-group">
						<select class="form-control" name="post_id">
							<?php 
							foreach (get_posts() as $post) {
                              echo  '<option value="$category["id"]" ';
                              /*if(isset($_GET['id'])) {
                              if($category_name === $category['name']) {
                              	echo "selected >";
                              }else {

                              	echo ">";


                               }

                              }else*/ {
                              	echo ">";
                              }
                               //
                              echo $post['title'];
                              echo "</option>";
							}
							?>
						</select>
					</div>
					
					

					

					<?php if(isset($_GET['id'])) { ?>
              <input value="Edit Comment" type="submit" name="updatecomment" class="btn btn-primary" style="float: right;">

					 <?php }else { ?>
					<input value="Add Comment" type="submit" name="addcomment" class="btn btn-primary" style="float: right;">
				<?php } ?>
				</form>
			</div>
		</div>
	</div>
</div>










<?php include "inc/footer.php"; ?>