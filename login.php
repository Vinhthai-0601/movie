<?php
include 'includes/header.php';
?>
<style media="screen">
  <?php include 'css/style.css'; ?>
  ::placeholder {
    color: white;
  }
  .site-navbar-wrap {
    position: unset !important;
    z-index: 1;
    width: 100%;
    left: 0;
  }
  .login-username {
  width: 100%;
  border-radius: 3rem;
  height: 45px;
  background: rgba(255,255,255,0.08);
  border: 1px solid #05feef;
  color: white;
  padding: 6px 12px;
}
.form-group {
    margin-bottom: 2rem;
}
.form-control {
  border-radius: 2rem;
  transition: 0.3s;
}
.container h1 {
  color: #f86b1c;
}
</style>
  <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
          <div class="login-wrap p-0">
            <h1 class="mb-4 text-center">Login</h1>
            <form class="" action="login.php" method="post">
              <div class="form-group">
                <input class="login-username" type="text" placeholder="Username" name="username" value="<?php if(isset($name)) {echo htmlspecialchars($name);} ?>">
              </div>
              <div class="form-group">
                <input class="login-username" type="password" placeholder="Password" name="password" value="">
              </div>
              <div class="form-group">
                <button class="form-control btn btn-success" type="submit" name="login">SIGN IN</button>
              </div>
              <div class="form-group text-center">
                  <a href="#" class="text-center text-light">Forgot Password</a>
              </div>
            </form>
            <p class="w-100 text-center text-light">Or sign in with</p>
            <div class="social text-center">
              <a href="#"><i class="fab fa-facebook p-3 display-4"></i></a>
              <a href="#"><i class="fab fa-twitter p-3 display-4"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php include 'includes/footer.php'; ?>
