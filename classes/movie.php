<?php 
class Movie {
    public $movie_id;
    public $movie_name;
    public $movie_img;
    public $movie_url;
    public $movie_details;
    public $movie_genre;
    public $movie_desc;
    public $movie = [];
    public $movies = [];
    public $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // function getMovie($movie_id, $conn) {
    //     $sql = "SELECT * FROM movies WHERE movie_id = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     var_dump($stmt);
    //     $stmt->bind_param("i", $this->movie_id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
        
    //     if($result->num_rows == 1) {
    //       return $result->fetch_assoc();
    //     }
    //   }
    public function getMovieDetails() {
        $sql = "SELECT * FROM movies WHERE movie_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->movie_id);
        $stmt->execute();
        $results = $stmt->get_results();
        if($results->num_rows == 1) {
            $this->movie = $results->fetch_assoc();
          }
    }
    public function updateMovie($movie_name, $movie_details, $movie_id) {
        $this->movie_id = $movie_id;
        $this->movie_name = $movie_name;
        $this->movie_details = $movie_details;
        //var_dump($this->movie_id);
        //$this->getMovieDetails();
        $sql = "UPDATE movies 
                SET movie_name = ?, movie_details = ?
                WHERE movie_id = $movie_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $this->movie_name, $this->movie_details);
        $stmt->execute();
        var_dump($stmt->affected_rows);
        if($stmt->affected_rows == 1) {
            $this->upload();
         }
    }
    public function upload() {
        header("Location: admin.php?edit=success");
    }

    public function Upload_movie() {
        if (isset($_POST['submit']) && isset($_FILES['my_video'])) {
            include "db_conn.php";
            $video_name = $_FILES['my_video']['name'];
            $vid_name = $_POST['vname'];
            $tmp_name = $_FILES['my_video']['tmp_name'];
            $error = $_FILES['my_video']['error'];
            
            $movie_details = $_POST['movie_details'];

            $movie_img_name = $_FILES['movie_img']['name'];
            $img_tmp_name = $_FILES['movie_img']['tmp_name'];
            
            
            $movie_img = "images/". '' .$movie_img_name;
            $img_upload_path = 'images/'.$movie_img_name;
            move_uploaded_file($img_tmp_name, $img_upload_path);

            if ($error === 0) {
                $video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
        
                $video_ex_lc = strtolower($video_ex);
        
                $allowed_exs = array("mp4", 'webm', 'avi', 'flv');
        
                if (in_array($video_ex_lc, $allowed_exs)) {
                    
                    $video_url = uniqid("video-", true). '.'.$video_ex_lc;
                    $video_upload_path = 'uploads/'.$video_url;
                    move_uploaded_file($tmp_name, $video_upload_path);
        
                    // Now let's Insert the video path into database
                    $sql = "INSERT INTO movies(movie_url, movie_name, movie_img, movie_details) 
                           VALUES('$video_url', '$vid_name', '$movie_img', '$movie_details')";
                    mysqli_query($conn, $sql);
                    header("Location: admin.php");
                }else {
                    $em = "You can't upload files of this type";
                    header("Location: admin.php?error=$em");
                }
            }
        
        
        }else{
            header("Location: admin.php");
        }
    }

    public function getMovies($movie_id) {
        $sql = "SELECT * FROM movies WHERE movie_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->comments = $result->fetch_all(MYSQLI_ASSOC);
      }

    public function output() {
        $host = "localhost";
        $user = "root";
        $pw = "";
        $db = "newmovies_db";
        $conn = new mysqli($host, $user, $pw, $db);
        $output = '';
        $query = "SELECT * FROM movies";
        $sql = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
                    <div class="col-md-3">
                          <div class="card">
                                  <a href="Moviedetail.php?id='. $row['movie_id'] .'">
                                    <img src="' . $row['movie_img'] . '" />
                                  </a>
                                  <div class="card-title">
                                    <h1>'. $row['movie_name'] .'</h1>
                                  </div>
                                  <h3>
                                  <span>
                                  2022 ‧ Action/Adventure
                                  </span>
                                  </h3>
                                  <br>
                                  <p>
                                  <span>
                                      <div class="row">
                                          <div class="col-md-6"> <button type="button" class="btn btn-outline-light" data-mdb-ripple-color="dark"><a href="editMovie.php?id='.$row['movie_id'].'"> Edit</a> <i class="fa-solid fa-pen-to-square"></i></button></div>
                                          <div class="col-md-6"  method="POST" action="function/manager.php"> <a href="function/manager.php?id='.$row['movie_id'].'">
                                          <button data-comment-id='. $row['movie_id'] .' type="button" class="btn btn-outline-warning" data-mdb-ripple-color="dark">Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
                                          </a>
                                          </div>
                                      </div>
                                  </span>
                                  </p>
                          </div>
                      </div>
            ';
          }
          echo $output;
    }

    public function displayMovie() {
        $host = "localhost";
        $user = "root";
        $pw = "";
        $db = "newmovies_db";
        $conn = new mysqli($host, $user, $pw, $db);
        $output = '';
        $query = "SELECT * FROM movies";
        $sql = mysqli_query($conn, $query);
        
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
              
                 
          
                    <div class="item">
                        <div class="card border-0 shadow">
                        <a href="Moviedetail.php?id='. $row['movie_id'] .'">
                            <img src="' . $row['movie_img'] . '"/>
                        </a>   
                        </div>
                    </div>
     
            ';
          }
          echo $output;
    }

    public function outputMoviesDetail($movie_id) {
        $host = "localhost";
        $user = "root";
        $pw = "";
        $db = "newmovies_db";
        $conn = new mysqli($host, $user, $pw, $db);
        $output = '';
        $query = "SELECT * FROM movies where movie_id = $movie_id";
        $sql = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql);
            $output .= '
            <div class="detail">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-thumbnail" src=" ' . $row['movie_img'] . '" alt="">
                    <div class="content">
                        <h1> ' . $row['movie_name'] . '</h1>
                        <h3>
                        <span>
                        2022 ‧ Action/Adventures
                        </span>
                        </h3>
                        <br>
                        <p>
                        <span>
                            <button type="button" class="btn btn-outline-light" data-mdb-ripple-color="dark">Add to play-list</button>
                            
                        
                                 
                               <a class="btn btn-outline-warning" href="Watchmovie.php?id=' . $row['movie_id'] . '">Watch Now</a>" 
                            
                        </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6"> 
                            <h2>Detail movie:</h2>
                        </div>
                    <div class="w-100"></div>
                        <div class="col-md-12"> <p> ' . $row['movie_details'] . '</p>
                        </div>
                        <button onclick="myFunction()" id="myBtn" style="color: white;border: #141414;background-color: #141414;width: fit-content; margin-left: 42%">Read more</button>
                    </div>
                </div>
            </div>
        </div>
            ';
          
          echo $output;
    }

    
    public function deleteMovie($movie_id) {
        if($_SESSION['user_role'] == 1) {
            $host = "localhost";
            $user = "root";
            $pw = "";
            $db = "newmovies_db";
            $conn = new mysqli($host, $user, $pw, $db);
            $query = "DELETE FROM movies WHERE movie_id = $movie_id";
            $sql = mysqli_query($conn, $query);
         
        } 
      }
}
?>