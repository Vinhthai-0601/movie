<?php 
  include 'includes/header.php';
  include 'classes/movie.php';
  if(isset($_GET['id'])) {
    $movie_id = $_GET['id'];
    $movies = new Movie($conn);
   
    
  }
?>

<style>
    img.img-thumbnail {
    height: 52vh;
    width: 100%;
}
.owl-nav {
    visibility: hidden;
  }

  .owl-carousel .owl-item img {
    height: 30vh;
  }
</style>
<link rel="stylesheet" href="css/detail.css">   
    <div class="container-fluid pt-lg-5">
    <?php  $movies->outputMoviesDetail($movie_id); ?>
        <div class="space" style="padding-top: 5rem;"></div>


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
</div>
    <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");
            var opac = document.getElementById("blur");
        
            if (dots.style.display === "none") {
            dots.style.display = "inline";
            opac.style.opacity = "0.5";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
            } else {
            opac.style.opacity = "0";
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
            }
        }
   </script>

<?php 
  include 'includes/footer.php';
?>