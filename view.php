<?php include 'function/search.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View</title>
	<style>
		body {
		    display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			min-height: 100vh;
		}
		video {
			width: 100%;
			height: 640px;
		}
		a {
			text-decoration: none;
			color: #006CFF;
			font-size: 1.5rem;
		}
	</style>
</head>
<body>
	<a href="upload.php">UPLOAD</a>
	<section class="search">
        <div class="container">
            <form action="searchview.php" method="get">
            <div class="all-input">
                <div>
                    <label for="">Search</label>
                    <input type="text" name="search" >
                </div>
            </div>

       
            <button class="btn-primary" type="submit" name="ok" value="search"> Search <span></span> </button>
            </form>
        </div>
    </section>

	<div class="wrapper">
                <?php 
					include "classes/movie.php";
					include "db_conn.php";
					
                    $movies = new Movie($conn);
                    $movies->output();
					
                 ?>            
    </div>

	<div class="alb">
		<?php 
		 include "db_conn.php";
		 $sql = "SELECT * FROM movies ORDER BY movie_id DESC";
		 $res = mysqli_query($conn, $sql);
		 if (mysqli_num_rows($res) > 0) {
		 	while ($video = mysqli_fetch_assoc($res)) { 
		 ?>
		 		
	        <video src="uploads/<?=$video['movie_url']?>" controls>
	        	
	        </video>
			<?php echo $video['movie_name']; 
			echo ("ID: ");
				echo $video['movie_id'];
			?>
			<?php echo "<a class='btn btn-outline-light' href='editMovie.php?id={$video['movie_id']}'>Edit <i class='fa-solid fa-pen-to-square'></i></a>" ?>
	    <?php 
	     }
		 }else {
		 	echo "<h1>Empty</h1>";
		 }
		 ?>
	</div>
</body>
</html>