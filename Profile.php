<?php 
  include 'includes/adminheader.php';
  include 'classes/user.php';
  include 'db.php';
  if(isset($_POST['update'])) {
    $user_img = $_FILES['profile_pic']['name'];
    $img_temp = $_FILES['profile_pic']['tmp_name'];
    $profile_img = "images/".''.$user_img;
    $profile_img_path = "images/".$user_img;
    move_uploaded_file($img_temp, $profile_img_path);
    $profile = new User($conn);
    $user_id = $_SESSION['user_id'];
    $profile->editProfile($profile_img, $user_id);
  }
  if(isset($_POST['confirm'])) {
    $profile_desc = $_POST['description'];
    $profile_name = $_POST['username'];
    $profile = new User($conn);
    $user_id = $_SESSION['user_id'];
    $profile->editProfileDesc($profile_name, $profile_desc, $user_id);
  }
  // var_dump($_FILES);
  //var_dump($_POST['update']);
  //var_dump($_POST['profile_pic']);
  //var_dump($user_img);
  //var_dump($_SESSION['user_name']);
?>
<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="css/Profile.css">   
<Style>
      i.fa.fa-camera {
    position: absolute;
    top: 19%;
    left: 22%;
    color: lightgray;
  }
  i.fa.fa-camera:hover {
    position: absolute;
    top: 19%;
    left: 22%;
    color: black;
  }
  .btn1 {
    width: 26px;
    height: 26px;
    background: white;
    border-radius: 50%;
    position: absolute;
    top: 17%;
    left: 707px;
    border: none;
}
.profile {
  object-fit: cover;
}
</Style>
    <div class="container-profile">
      <div class="cover-photo">
        <?php     
          $output = '';
          $user_id = $_SESSION['user_id'];
          $query = "SELECT * FROM users WHERE ID = $user_id";
          $sql = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($sql);
          $output .= '
          <img id="image" src="'.$row['profile_img'].'" class="profile">
          ';
          echo $output;
     ?>
      </div>
      <div>
      <!-- data-mdb-toggle="tooltip" title="Edit the picture" data-mdb-placement="bottom" -->
        <button type="submit" class="btn1" data-mdb-toggle="modal" data-mdb-target="#exampleModal"
        data-mdb-whatever="@fat"><i class="fa fa-camera" aria-hidden="true"></i></button>
      </div>
      <div class="profile-name"><?php echo htmlspecialchars($_SESSION['user_name']) ?></div>
      <p class="about"><?php echo htmlspecialchars($_SESSION['description']) ?></p>
      <button class="follow-btn" data-mdb-toggle="modal" data-mdb-target="#updateModal"
        data-mdb-whatever="@fat">Update</button>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Image</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="Profile.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Image:</label>
              <input type="file" class="form-control" id="recipient-name" name="profile_pic" value="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="update">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>    

  <!-- update modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="Profile.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Username:</label>
              <input type="text" class="form-control" id="recipient-name" name="username" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Description:</label>
              <input type="text" class="form-control" id="recipient-name" name="description" value="<?php echo htmlspecialchars($_SESSION['description']);?>">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="confirm">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>    
</body>
</html>
<?php 
  include 'includes/footer.php';
?>