<?php
  session_start();
  include 'classes/movie.php';
  include "db_conn.php";
  if(isset($_POST['submit']) && isset($_FILES['my_video'])) {
	$video_name = $_FILES['my_video']['name'];
	$vid_name = $_POST['vname'];
	$tmp_name = $_FILES['my_video']['tmp_name'];
	$error = $_FILES['my_video']['error'];
	
	$film = new Movie($conn);
	$film->Upload_movie();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>video upload php and mysql</title>
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
		}
		input {
			font-size: 2rem;
		}
		a {
			text-decoration: none;
			color: #006CFF;
			font-size: 1.5rem;
		}
	</style>
</head>
<body>
	<a href="view.php">Videos</a>
	<?php if (isset($_GET['error'])) {  ?>
		<p><?=$_GET['error']?></p>
	<?php } ?>

	
	 <form action="#"
	       method="post"
	       enctype="multipart/form-data">

		<div class="m-3">
			<label for="vname" class="col-form-label">Movie Name</label>
			<input type="text" name="vname">
		</div>
		<div class="m-3">
			<label for="movie-details" class="col-form-label">Movie Details</label>
			<textarea class="form-control" name="movie_details"></textarea>
		</div>
		<div class="m-3">
			<label for="Movie-url" class="col-form-label">Movie file</label>
			<input type="file" name="my_video">
		</div>
		<div class="m-3">
			<label for="Movie-img" class="col-form-label">Movie Image</label>
			<input type="file" name="movie_img">
		</div>
	 	<input type="submit"
	 	       name="submit" 
	 	       value="Upload">
	 </form>
</body>
</html>