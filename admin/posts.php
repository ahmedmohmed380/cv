<?php include "inc/header.php"; ?>
<?php include "inc/navbar.php"; ?>
<?php include "inc/functions.php"; ?>
<?php include "inc/connect.php"; ?>




<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
   <?php include "inc/sidebar.php"; ?>
    </div>
  <div class="col-sm">
  	<h4>Posts</h4>
<div class="table-resposive">
    <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">datatime</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Image</th>
      <th scope="col">Author</th>
      <th scope="col">Actions</th>
     
    </tr>
  </thead>
  <tbody>



<?php
$number = 0;

 foreach(get_posts() as $post) { $number ++; ?>


    <tr>
      <th scope="row"><?php echo $number; ?></th>
      <td><?php echo $post['datetime']; ?></td>
      <td class="title">
      	<?php
      	if(strlen($post['title']) > 10) {
           echo substr($post['title'], 0,10)  . "...";
           }else {
            echo $post['title']; 
           }
      	 ?>
      	</td>
       <td class="content" style="min-width: 200px;">
      	<?php
      	if(strlen($post['content']) > 30) {
           echo substr($post['content'], 0,30)  . "...";
           }else {
            echo $post['content']; 
           }
      	 ?>
      	</td>
      	<td>
      		<?php if(! empty($post['image'])) { ?>
      <img class="" alt="Post Banner" width="100" src="uploads/posts/<?php echo $post['image']; ?>">
  <?php } else {
  	echo "NO Image";
  }
  ?>
      </td>


      <td><?php echo $post['author']; ?></td>



      <td class="action-links" style="width: 130px;">
      	<a class="btn btn-primary btn-sm" href="">Edit</a>
      	<form action="deletepost.php" method="" style="display: initial;">
      		<input class="btn btn-danger btn-sm" type="submit" value="Delete" name="deletepost">
      	</form>
      </td>
    </tr> 

<?php } ?>




  </tbody>
</table>
<a class="btn btn-info" style="float: right;" href="post.php">Add New Post</a>
</div>
</div>

  </div>
</div>











    <?php include "inc/footer.php"; ?>