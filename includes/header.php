<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = false;
}
include 'db.php'; ?>
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
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .sidebar li {
    position: relative;
    margin: 8px 0;
    list-style: none;
}
  .sidebar input {
  font-size: 15px;
  color: #FFF;
  padding: 0 20px 0 50px;
  font-weight: 400;
  outline: none;
  height: 50px;
  width: 100%;
  border: none;
  border-radius: 12px;
  transition: all 0.5s ease;
  background: #1d1b31;
}
.sidebar .fa-search {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    font-size: 22px;
    background: #1d1b31;
    color: #FFF;
}
</style>
<body>
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    <div class="site-navbar-wrap">
      <div class="site-navbar-top">
        <div class="container py-3">
          <div class="row align-items-center">
            <div class="col-6">
              <div class="d-flex mr-auto">
                <a href="#" class="d-flex align-items-center">
                  <span class="mr-2"> <i class="fa fa-envelope" aria-hidden="true"></i> </span>
                  <span class="d-none d-md-inline-block">info@domain.com</span>
                </a>
                <a href="#" class="d-flex align-items-center ms-5">
                  <span class="mr-2"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                  <span class="d-none d-md-inline-block">+1 234 4567 8910</span>
                </a>
              </div>
            </div>
            <div class="col-6 text-right" style="text-align: end;">
              <div class="mr-auto">
                <a href="#" class="p-2 pl-0"><span> <i class="fab fa-twitter"></i> </span></a>
                <a href="#" class="p-2 pl-0"><span> <i class="fab fa-facebook"></i> </span></a>
                <a href="#" class="p-2 pl-0"><span> <i class="fab fa-linkedin"></i> </span></a>
                <a href="#" class="p-2 pl-0"><span> <i class="fab fa-instagram"></i></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="site-navbar site-navbar-target js-sticky-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-2">
              <h1 class="my-0 site-logo"
              style="background: -webkit-linear-gradient(orange, #333); -webkit-background-clip: text; -webkit-text-fill-color: transparent; height: 3vh; top: 0px;">
              <a href="Homepage.php">NewMovies</a></h1>
            </div>
            <div class="col-7">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                  <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>
                  <ul class="site-menu main-menu js-clone-nav d-none d-lg-block"  style="text-align: end;">
                  <div class="sidebar">
                  </div>
                    <li class="active"><a href="#home-section" class="nav-link">Home</a></li>
                    <li><a href="#classes-section" class="nav-link">Classes</a></li>
                    <li class="has-children">
                      <a href="#" class="nav-link">Pages</a><i class="fa fa-angle-down" style="color: #7e7e7e;" aria-hidden="true"></i>
                      <ul class="dropdown arrow-top">
                        <li><a href="#" class="nav-link">Team</a></li>
                        <li><a href="#" class="nav-link">Pricing</a></li>
                        <li><a href="#" class="nav-link">FAQ</a></li>
                      </ul>
                    </li>
                    <li><a href="#about-section" class="nav-link">About</a></li>
                    <li><a href="#events-section" class="nav-link">Events</a></li>
                    <li><a href="#gallery-section" class="nav-link">Gallery</a></li>
                    <li><a href="#contact-section" class="nav-link">Contact</a></li>
                  </ul>
                </div>
              </nav>
            </div>
            <div class="col-3">
              <nav class="site-navigation text-left" role="navigation">
                <div class="container">
                  <ul class="site-menu main menu" style="text-align: end;">
                    <li class="nav-item avtive">
                      <a href="Profile.php" class="nav-link">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
                    </li>
                    <?php if ($_SESSION['user_role'] == 1) : ?>
                      <li class="nav-item">
                        <a href="admin.php" class="nav-link">Admin</a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>