<?php
  session_start();
  //include 'includes/header.php';
  include 'classes/user.php';
  include 'db.php';
  if(isset($_POST['create-account'])) {
    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password1 = $_POST['password1'];
    $user_password2 = $_POST['password2'];
    $user = new User($conn);
    $user->checkNewUser($user_name, $user_email, $user_password1, $user_password2);
    $errors = $user->errors;
  }
?>
<style media="screen">
  <?php include 'css/style.css'; ?>
  ::placeholder {
    color: white;
  }
  .signup {
  width: 100%;
  border-radius: 3rem;
  height: 45px;
  background: rgba(255,255,255,0.08);
  border: 1px solid #ffa900;
  color: white;
  padding: 6px 12px;
}
.logo {
  color: #ffa900 !important;
}
.row {
  margin-top: 8rem !important;
}
.form-control {
  border-radius: 2rem;
  transition: 0.3s;
}
.container h1 {
  color: #f86b1c;
}
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>NewMovies</title>
    <!-- MDB icon -->
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1038/1038100.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
<div class="container-fluid">
  <section>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
              <h1 class="mb-4 text-center">Sign up</h1>
              <form class="" action="signup.php" method="post">
                <div class="form-group">
                  <label for="username"></label>
                  <input class="signup signup-username" type="text" placeholder="Username" name="username" value="" >
                  <p class="text-danger error"><?php if(isset($errors['create_username'])) {echo $errors['create_username'];} ?></p>
                  <p class="text-danger error"><?php if(isset($errors['signup_username'])) {echo $errors['signup_username'];} ?></p>
                  <p class="text-danger error"><?php if(isset($errors['username_existed'])) {echo $errors['username_existed'];} ?></p>
                </div>
                <div class="form-group">
                  <label for="email"></label>
                  <input class="signup signup-emails" type="email" placeholder="Email" name="email" value="">
                  <p class="text-danger error"><?php if(isset($errors['signup_email'])) { echo $errors['signup_email'];} ?></p>  
                  <p class="text-danger error"><?php if(isset($errors['email_existed'])) { echo $errors['email_existed'];} ?></p>  
                </div>
                <div class="form-group">
                  <label for="password1"></label>
                  <input class="signup signup-password1" type="password" placeholder="Password" name="password1" value="">
                  <p class="text-danger error"><?php if(isset($errors['create_password'])) { echo $errors['create_password'];} ?></p>
                  <p class="text-danger error"><?php if(isset($errors['pw_error'])) { echo $errors['pw_error'];} ?></p>
                </div>
                <div class="form-group">
                  <label for="password2"></label>
                  <input class="signup signup-password2" type="password" placeholder="Confirm Password" name="password2" value="">
                  <p class="text-danger error"><?php if(isset($errors['create_password'])) { echo $errors['create_password'];} ?></p>
                  <p class="text-danger error"><?php if(isset($errors['pw_error'])) { echo $errors['pw_error'];} ?></p>
                </div>
                <br>  
                <div class="form-group">
                    <button class="form-control btn btn-warning" type="submit" name="create-account">CREATE ACCOUNT</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
<?php include 'includes/footer.php'; ?>