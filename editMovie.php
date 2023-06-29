<?php
include 'includes/adminheader.php';
include 'classes/movie.php';
//include 'view.php';
$errors = [];
if(isset($_GET['id'])) {
    $_SESSION['movie_id'] = $_GET['id'];
}
if(isset($_POST['edit'])) {
    $movie_name = $_POST['movie_name'];
    $movie_details = $_POST['movie_info'];
    $movie = new Movie($conn);
    $movie->updateMovie($movie_name, $movie_details, $_SESSION['movie_id']);
}
//var_dump($_SESSION['movie_id']);
//var_dump($chapter);
//var_dump($contentInfo);
//var_dump($contentType);
//var_dump($contentFile);
?>
<style>
    .site-navbar-wrap {
        position: unset!important;
    }
    .container h1 {
        color: #f86b1c;
    }
    .form-control {
        background: rgba(255,255,255,0.08);
        border: 1px solid #ffa900;
    }
    ::placeholder {
    color: white!important;
    }
    label {
        color: #f86b1c;
    }
</style>
<br>
<br>
<br>
<div class="container">
  <div class="row">
      
      <div class="mt-3 col-md-6 offset-md-3">
        <h1>Edit here</h1>
        
        <form action="editMovie.php" method="post" enctype="multipart/form-data">     
          <label for="movie_name">Movie name</label>
          <input type="text" name="movie_name" placeholder="Move name here" value="" class="form-control">
          <br>

          <label for="movie_info">Movie description</label>
          <textarea name="movie_info" class="form-control" placeholder="Movie description" rows="8" cols="80"></textarea>
          <br>

          <button type="submit" name="edit" class="btn btn-warning btn-block"> <i class="fas fa-edit"></i> Confirm</button>
       </form>
      </div>
    
  </div>
</div>
<br>
<?php
include 'includes/footer.php';
?>
