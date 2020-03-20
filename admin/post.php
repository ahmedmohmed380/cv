<?php 
include "inc/header.php";
include "inc/navbar.php";
include "inc/functions.php";


?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<?php include "inc/sidebar.php"; ?>
		</div>
		<div class="col-sm">
			<div class="post">
				<h3>Add new Post</h3>
				<form action="post.php" method="POST" enctype="multipart/form-date">
					<div class="form-group">
						<input class="form-control" type="text" name="title" placeholder="Title" required autocomplete="off" >
						<p class="error title-error">Title the must be between 10 and 200 characters</p>
					</div>
					<div class="form-group">
						<textarea required placeholder="Content" autocomplete="off" rows="6" name="content" class="form-control"></textarea>
							<p class="error content-error">Content the must be between100 and 100000 characters</p>
					</div>
					<div class="form-group">
						<select class="form-control" name="category">
							<?php 
							foreach (get_categories() as $category) {
                              echo "<option>";
                              echo $category['name'];
                              echo "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="excerpt" autocomplete="off" placeholder="Excerpt( Optional )">
							<p class="error excerpt-error">Excerpt the must be between 10 and 1000 characters</p>
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="tags" autocomplete="off" placeholder="Tags">
					</div>
					<div class="form-group">
						<input type="file" name="image" class="form-control">
					</div>
					<input value="Add Post" type="submit" name="addpost" class="btn btn-primary" style="float: right;">
				</form>
			</div>
		</div>
	</div>
</div>










<?php include "inc/footer.php"; ?>