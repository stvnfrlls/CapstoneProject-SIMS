<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['SR_number'])) {
  header('Location: ../auth/login.php');
} else {
  # code...
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Student - Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/dashboard-user.css" rel="stylesheet">
  <link href="../assets/css/admin/style.css" rel="stylesheet">
  <link href="../assets/css/educ/main.css" rel="stylesheet">
</head>

<body>
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
    <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:400px;" alt="Icon">
  </nav>
  <!-- Navbar End -->

  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <style>
        @media (max-width: 991.98px) {
          .navbar-nav {
            margin-left: 0px !important;
          }

          .navbar .navbar-nav .nav-link {
            margin-left: 0px !important;
          }
        }
      </style>
      <div class="navbar-nav m-auto p-4 p-lg-0 ">
        <a href="../index.php" class="nav-item nav-link active" style="color: white; font-size: 14px;">Home</a>
        <a href="" class="nav-item nav-link" style="color: white; font-size: 14px;">About Us</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown" style="color: white; font-size: 14px;">Dashboard <i class="fa fa-caret-down"></i></a>
          <div class="dropdown-menu bg-dark border-0 m-0">
            <a href="../student/profile.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Profile</a>
            <a href="../student/grades.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Grades</a>
            <a href="../student/dailyAttendance.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Attendance</a>
            <a href="../student/reminders.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Reminders</a>
            <a href="../student/announcement.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">School Announcements</a>
          </div>
        </div>
        <a href="" class="nav-item nav-link" style="color: white; font-size: 14px;">Contact Us</a>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->


  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="home-tab">

          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview">
              <div class="row">
                <div class="col-sm-12 col-lg-8 grid-margin">
                  <div class="border-bottom" style="margin-bottom: 20px;">
                    <div class="row">
                      <style>
                        h3 {
                          font-family: "Lato", "san serif";
                        }
                      </style>
                      <div class="col-sm-12 col-lg-6 grid-margin" style="margin: auto; padding-bottom: 20px;">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-4">
                                <img src="../assets/img/profile.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
                              </div>
                              <div class="col-8" style="align-self: center;">
                                <h3 style="margin-bottom: 8px;">Camille Anne G. Sabile</h3>
                                <p style="margin-bottom: 2px;">2019-00188-SP-0</p>
                                <p style="margin-bottom: 2px;">Grade 1 - Chrysanthemum</p>
                                <p style="margin-bottom: 2px;">Ms. Hazel Grace L. Cantuba</p>
                                <p style="margin-bottom: 2px;">S.Y. 2022-2023</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-2 grid-margin" style="margin: auto;  padding-bottom: 20px;">
                        <div class="card" style="height: 150px; padding-top: 12px;">
                          <div class="card-body">
                            <p class="d-flex flex-shrink-0 align-items-center justify-content-center text-center">Total Days of Present</p>
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                              <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628;">25</h1>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-2 grid-margin" style="margin: auto;  padding-bottom: 20px;">
                        <div class="card" style="height: 150px; padding-top: 12px;">
                          <div class="card-body">
                            <p class="d-flex flex-shrink-0 align-items-center justify-content-center text-center">Total Days of Absent</p>
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                              <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628;">25</h1>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-2 grid-margin" style="margin: auto;  padding-bottom: 20px;">
                        <div class="card" style="height: 150px; padding-top: 12px;">
                          <div class="card-body">
                            <p class="d-flex flex-shrink-0 align-items-center justify-content-center text-center">Total Days of Late</p>
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                              <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628;">25</h1>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 col-lg-3 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                            <h1 class="display-1 mb-n2" style="font-size:30px; color:#c02628; padding-bottom: 25px;"><i class="fa fa-user"></i></h1>
                          </div>
                          <a href="../student/profile.php">
                            <h3 class="d-flex flex-shrink-0 align-items-center justify-content-center">Profile</h3>
                          </a>
                          <p class="d-flex flex-shrink-0 text-center">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                            <h1 class="display-1 mb-n2" style="font-size:30px; color:#c02628; padding-bottom: 25px;"><i class="fa fa-qrcode"></i></h1>
                          </div>
                          <a href="">
                            <h3 class="d-flex flex-shrink-0 align-items-center justify-content-center">QR Code</h3>
                          </a>
                          <p class="d-flex flex-shrink-0 text-center">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                            <h1 class="display-1 mb-n2" style="font-size:30px; color:#c02628; padding-bottom: 25px;"><i class="fa fa-book"></i></h1>
                          </div>
                          <a href="../student/dailyAttendance.php">
                            <h3 class="d-flex flex-shrink-0 align-items-center justify-content-center">Attendance</h3>
                          </a>
                          <p class="d-flex flex-shrink-0 text-center">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                            <h1 class="display-1 mb-n2" style="font-size:30px; color:#c02628; padding-bottom: 25px;"><i class="fa fa-edit"></i></h1>
                          </div>
                          <a href="../student/grades.php">
                            <h3 class="d-flex flex-shrink-0 align-items-center justify-content-center">Grades</h3>
                          </a>
                          <p class="d-flex flex-shrink-0 text-center">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    <div class="row">
                      <div class="col-lg-6 offset-lg-3" style="margin-top: 30px;">
                        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                          <h3 class="mb-0">Reminders</h3>
                        </div>
                      </div>
                      <div class="row" style="margin: auto;">
                        <div class="col-lg-4 col-sm-12">
                          <div class="card">
                            <div class="card-body">
                              <div class="user-details row">
                                <p class="user-name col-12" style="text-align:center;"><a href="#">Mark wiens</a> <span class="far fa-user" style="color: #c02628;"></span></p>
                                <p class="date col-12" style="text-align:center;"><a>12 Dec, 2017</a> <span class="fa fa-calendar" style="color: #c02628;"></span></p>
                              </div>
                              <div class="col-12">
                                <a class="posts-title" href="blog-single.html">
                                  <h3 style="text-align: justify">Bring a noteboook</h3>
                                </a>
                                <p>Subject: English</p>
                                <p class="excert">
                                  MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction.
                                </p>
                                <a href="blog-single.html" class="primary-btn">View More</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                          <div class="card">
                            <div class="card-body">
                              <div class="user-details row">
                                <p class="user-name col-12" style="text-align:center;"><a href="#">Mark wiens</a> <span class="far fa-user" style="color: #c02628;"></span></p>
                                <p class="date col-12" style="text-align:center;"><a>12 Dec, 2017</a> <span class="fa fa-calendar" style="color: #c02628;"></span></p>
                              </div>
                              <div class="col-12">
                                <a class="posts-title" href="blog-single.html">
                                  <h3 style="text-align: justify">Bring a noteboook</h3>
                                </a>
                                <p>Subject: English</p>
                                <p class="excert">
                                  MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction.
                                </p>
                                <a href="blog-single.html" class="primary-btn">View More</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                          <div class="card">
                            <div class="card-body">
                              <div class="user-details row">
                                <p class="user-name col-12" style="text-align:center;"><a href="#">Mark wiens</a> <span class="far fa-user" style="color: #c02628;"></span></p>
                                <p class="date col-12" style="text-align:center;"><a>12 Dec, 2017</a> <span class="fa fa-calendar" style="color: #c02628;"></span></p>
                              </div>
                              <div class="col-12">
                                <a class="posts-title" href="blog-single.html">
                                  <h3 style="text-align: justify">Bring a noteboook</h3>
                                </a>
                                <p>Subject: English</p>
                                <p class="excert">
                                  MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction.
                                </p>
                                <a href="blog-single.html" class="primary-btn">View More</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-lg-4 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0" style="text-align:left;">School Announcements</h3>
                      </div>
                      <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                        <div class="blog-item bg-light rounded overflow-hidden">
                          <div class="p-4">
                            <div class="d-flex mb-3">
                              <small class="me-3"><i class="far fa-user text-primary me-2"></i>Steven Frilles</small>
                              <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="../student/announcement.php">Read More <i class="bi bi-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                        <div class="blog-item bg-light rounded overflow-hidden">
                          <div class="p-4">
                            <div class="d-flex mb-3">
                              <small class="me-3"><i class="far fa-user text-primary me-2"></i>Steven Frilles</small>
                              <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="../student/announcement.php">Read More <i class="bi bi-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                        <div class="blog-item bg-light rounded overflow-hidden">
                          <div class="p-4">
                            <div class="d-flex mb-3">
                              <small class="me-3"><i class="far fa-user text-primary me-2"></i>Steven Frilles</small>
                              <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="../student/announcement.php">Read More <i class="bi bi-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 wow" style="padding-bottom: 5px;">
                        <div class="blog-item bg-light rounded overflow-hidden">
                          <div class="p-4">
                            <div class="d-flex mb-3">
                              <small class="me-3"><i class="far fa-user text-primary me-2"></i>Steven Frilles</small>
                              <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="../student/announcement.php">Read More <i class="bi bi-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>
                      <section class="popular-courses-area courses-page">
                        <div style="text-align: center;">
                          <a href="#" class="primary-btn text-uppercase" style="width: auto;">View More School Announcements</a>
                        </div>
                      </section>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-body footer wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-3 col-md-6">
          <h3 class="text-light mb-4">Address</h3>
          <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Phase 1A, Pacita Complex 1, San Pedro City, Laguna 4023</p>
          <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+63 919 065 6576</p>
          <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>di ko alam email</p>
          <div class="d-flex pt-2">
            <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-twitter"></i></a>
            <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-youtube"></i></a>
            <a class="btn btn-square btn-outline-body me-0" href=""><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <h3 class="text-light mb-4">Quick Links</h3>
          <a class="btn btn-link" href="">Home</a>
          <a class="btn btn-link" href="">About Us</a>
          <a class="btn btn-link" href="">Academics</a>
          <a class="btn btn-link" href="">Admission</a>
        </div>
        <div class="col-lg-3 col-md-6">
          <h3 class="text-light mb-4">Useful Links</h3>
          <a class="btn btn-link" href="">DepEd</a>
          <a class="btn btn-link" href="">Pag Asa</a>
          <a class="btn btn-link" href="">City of San Pedro</a>
        </div>
        <div class="col-lg-3 col-md-6">
          <h3 class="text-light mb-4">Newsletter</h3>
          <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
          <div class="position-relative mx-auto" style="max-width: 400px;">
            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid copyright">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            &copy; <a href="#">Colegio De San Pedro</a>, All Right Reserved.
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End -->

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/lib/wow/wow.min.js"></script>
  <script src="../assets/lib/easing/easing.min.js"></script>
  <script src="../assets/lib/waypoints/waypoints.min.js"></script>
  <script src="../assets/lib/counterup/counterup.min.js"></script>
  <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../assets/lib/tempusdominus/js/moment.min.js"></script>
  <script src="../assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="../assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="../assets/../assets/js/main.js"></script>

  <!-- Javascript -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/admin/dashboard.js"></script>

  <script src="../assets/js/eduwell/isotope.min.js"></script>
  <script src="../assets/js/eduwell/owl-carousel.js"></script>
  <script src="../assets/js/eduwell/lightbox.js"></script>
  <script src="../assets/js/eduwell/tabs.js"></script>
  <script src="../assets/js/eduwell/video.js"></script>
  <script src="../assets/js/eduwell/slick-slider.js"></script>
  <script src="../assets/js/eduwell/custom.js"></script>
  <script src="../assets/js/startup/main.js"></script>

</body>

</html>