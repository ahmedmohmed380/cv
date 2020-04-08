<?php include "inc/header.php"; ?>
<?php include "inc/functions.php"; ?>
<?php include "inc/navbar.php"; ?>



<?php

foreach (get_settings() as $setting) {

    $name = $setting['name'];
    $tagline = $setting['tagline'];
    $logo = $setting['logo'];
    $hpn = $setting['home_posts_number'];
    $posts_order = $setting['posts_order'];
    $rpn = $setting['recent_posts_number'];
    $relateddpn = $setting['related_posts_number'];

  }
?>


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
   <?php include "inc/sidebar.php"; ?>
    </div>
  <div class="col-sm">

  	<div class="settings">
  		<div class="general-settings">
  			<h4>General Settings</h4>
  			<form action="settings.php" method="POST" enctype="multipart/from-data">
  				<div class="row">
  				<div class="col-sm-2">
  					<label>Site Name :</label>
  				</div>
  				<div class="col-sm-6">
  					<div class="form-group">
  						<input value="<?php echo $name; ?>" type="text" name="name" class="form-control" placeholder="Site Name" required autocomplete="">
  				</div>
  			</div>
  		</div>
  		<div class="row">
  				<div class="col-sm-2">
  					<label>Site Tagline :</label>
  				</div>
  				<div class="col-sm-6">
  					<div class="form-group">
  						<input value="<?php echo $tagline; ?>" min="1" max="20" type="text" name="tagline" class="form-control" placeholder="Site tagline" required autocomplete="">
  				</div>
  			</div>
  		</div>
  		<div class="row">
  				<div class="col-sm-2">
  					<label>Site Logo :</label>
  				</div>
  				<div class="col-sm-6">
  					<div class="form-group">
  						<img class="logo" width="150" height="150" src="uploads/<?php echo $logo; ?>">
  						<input type="file" name="logo" class="form-control">
  						<input style="float: right;" type="submit" name="save-general" class="btn btn-info" value="Save Changes">

  				</div>
  			</div>
  		</div>
  			</form>
  		</div>
  		<div class="posts-settings">

  			<hr>
             <h4>Posts Settings</h4>
  			<form action="settings.php" method="POST">
  				<div class="row">
  				<div class="col-sm-2">
  					<label>Home Posts Number :</label>
  				</div>
  				<div class="col-sm-6">
  					<div class="form-group">
  						<input value="<?php echo $hpn; ?>" min="1" max="20" type="number" name="hpn" class="form-control">
  				</div>
  			</div>
  		</div>
  		<div class="row">
  				<div class="col-sm-2">
  					<label>Posts Order :</label>
  				</div>
  				<div class="col-sm-6">
  					<div class="form-group">
  						<select class="form-control" name="posts_order">
  							<?php
                             if($posts_order === "newst") {
                             	echo "<option value='newest' selected > Newest";
                             	echo "</option>";
                             	echo "<option value='oldest'>Oldest";
                             	echo "</option>";
                             }else {
                             	echo "<option value='newest' >Newest";
                             	echo "</option>";
                             	echo "<option value='oldest' selected>Oldest";
                             	echo "</option>";
                             }


  							?>
  						</select>
  				</div>
  			</div>
  		</div>
  		<div class="row">
  				<div class="col-sm-2">
  					<label>Recent Posts Number :</label>
  				</div>
  				<div class="col-sm-6">
  					<div class="form-group">
  						 <input value="<?php echo $rpn; ?>" min="1" max="10" type="number" name="rpn" class="form-control">

  				</div>
  			</div>
  		</div>
  		<div class="row">
  				<div class="col-sm-2">
  					<label>Related Posts Number :</label>
  				</div>
  				<div class="col-sm-6">
  					<div class="form-group">
  						 <input value="<?php echo $relateddpn; ?>" min="1" max="3" type="number" name="relateddpn" class="form-control">
  						 <input style="float: right;" class="btn btn-info" type="submit" name="save-posts" value="Save Changes">

  				</div>
  			</div>
  		</div>
  			</form>
  		</div>


  		</div>
  	</div>
    </div>
  </div>
</div>











    <?php include "inc/footer.php"; ?>