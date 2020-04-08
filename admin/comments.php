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
    <div class="comments">


      <?php 
           if( ! session_id() ) {
             session_start();
          }
         if( isset($_SESSION['success']) && ! empty($_SESSION['success'])) {
            echo "<div class='alert alert-success'>";
              echo $_SESSION['success'];
                echo "</div>";
                $_SESSION['success'] = "";
                  }
                    if( isset($_SESSION['error']) && ! empty($_SESSION['error'])) {
                          echo "<div class='alert alert-danger'>";
                           echo $_SESSION['error'];
                             echo "</div>";
                             $_SESSION['error'] = "";
                        
      
                      }
      ?>



  	<h4>Comments</h4>
<div class="table-resposive">
    <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Created_at</th>
      <th scope="col">Name</th>
      <th scope="col">Comment</th>
      <th scope="col">Post Title</th>
      <th scope="col">Actions</th>
     
    </tr>
  </thead>
  <tbody>



<?php
$number = 0;

 foreach(get_comments() as $Comment) { $number ++; ?>


    <tr>
      <th scope="row"><?php echo $number; ?></th>
      <td><?php echo $comment['datetime']; ?></td>
      <td>
      	<?php
            echo $comment['coomenter_name']; 
      	 ?>
      	</td>
     
      

      <td>
        <?php 

          if(strlen($comment['comment']) > 20){
            echo substr($comment['coment'], 0, 20)."...";
          }else {
            echo $comment['comment'];
          }
       ?>
       </td>

      <td><?php 
      $post_id = $Comment['post_id'];
      $post_title = get_posts($post_id)['title'];
      

          if(strlen($post_title) > 10){
            echo substr($post_title, 0, 10)."...";
          }else {
            echo $post_title;
          }
     
      ?>
    </td>

    
      <td class="action-links" style="width: 130px;">
      	<a class="btn btn-primary btn-sm" href="Comment.php?id=<?php echo $Comment['id']; ?>">Edit</a>
      	<form onsubmit="return confirm('Are You Sure?');" action="deleteadmin.php" method="POST" style="display: initial;">
      		<input type="hidden" name="id" value="<?php echo $Comment['id']; ?>">
      		<input class="btn btn-danger btn-sm" type="submit" value="Delete" name="deletecomment">
          <input class="btn btn-danger btn-sm" type="submit" value="Approve" name="approvecomment">

      	</form>
      </td>
    </tr> 

<?php } ?>




  </tbody>
</table>
<a class="btn btn-info" style="float: right;" href="admin.php">Add New Comment</a>
</div>
</div>
</div>
  </div>
</div>











    <?php include "inc/footer.php"; ?>