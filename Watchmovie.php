<?php 
  include 'includes/header.php';
  include 'classes/comment.php';
  include 'classes/reply.php';
  include 'classes/movie.php';
  if(isset($_GET['id'])) {
    $theid = $_GET['id'];
    $movie_id = $theid;
    $comments = new Comment($theid, $conn);
    $comments->getComments();
    $replies = new Reply($theid, $conn);
    $replies->getReplies();
    
  }
?>
<style>
.owl-nav {
    visibility: hidden;
  }

  .owl-carousel .owl-item img {
    height: 30vh;
  }
</style>
<link rel="stylesheet" href="css/watch.css">

<div class="space" style="padding-top: 8rem;"></div>
<!-- Watch movie -->
<div class="watch">
  <?php 
    $output = '';
     $query = "SELECT * FROM movies WHERE movie_id = $movie_id";
     $sql = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($sql);
     $output .= '
     <a href="Moviedetail.php?id='. $row['movie_id'] .'">
         <img src="' . $row['movie_img'] . '" />
     </a>
    ';
  ?>
    <video loop id="myVideo"
        src="uploads/<?=$row['movie_url']?>" controls type="video/mp4">
    </video>

</div>
<!-- End of watch movie -->

<!-- Comments -->
<hr>
    <div class="container">
      <h3 class="display-4 mt-3 mb-3 text-white">Comments</h3>
      <hr>
      <?php if ($_SESSION['loggedin']): ?>
    
      <div class="comment-form">
        <div class="form">
          <form class="comment-form" method="POST" action="function/manager.php">
            <textarea name="comment-text" class="form-control" rows="4" cols="80"></textarea>
            <input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>">
            <button type="submit" name="comment-submit" class="comment-submit btn btn-warning mt-2"><i class="far fa-comment"></i>Add Comment</button>
          </form>
        </div>
      </div>

    </div>
    <div class="container">
        <div class="comments">
            <?php $comments->outputComments($replies);?>
            
            <?php else: ?>
            <h3>Please login to comment!</h3>
            <a href="login.php"><button type="button" class="btn btn-primary btn-lg">Login</button></a>
            <?php endif; ?>
        </div>
     </div>


<!-- Similar Content -->
        <div class="container-fluid pt-lg-5 pb-5">
            <div class="tile">
             <h2 style="color: orange;" >Similar content:</h2>
            </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="owl-carousel owl-theme">
                            <?php 
                                include "db_conn.php";
                                
                                $movies = new Movie($conn);
                                $movies->displayMovie(); 
                            ?>   
                            </div>
                        </div>
                    </div>
                </div>


<?php
if(isset($_POST['delete-comment'])){
    $queryIDCount = count($_SESSION['query_history']) - 2;
    $queryStrPos = strpos($_SESSION['query_history'][$queryIDCount],"id");
    $queryId = substr($_SESSION['query_history'][$queryIDCount],$queryStrPos);
    $queryId = explode("=", $queryId);
  }

 include 'includes/footer.php';
?>