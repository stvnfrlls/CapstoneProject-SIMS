<?php
require_once("../assets/php/server.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Edit Student Information</title>
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
  <link href="../assets/css/form-style.css" rel="stylesheet">
  <link href="../assets/css/admin/style.css" rel="stylesheet">
  <link href="../assets/css/admin/materialdesignicons.min.css" rel="stylesheet">

</head>

<body>
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
    <img class="m-3" src="../assets/img/logo.png" style="height: 50px; width:50px;" alt="Icon">
    <div class="d-flex align-items-center justify-content-center text-center">
      <a href="../index.php" class="navbar-brand ms-4 ms-lg-0 text-center">
        <h1 class="cdsp">Colegio De San Pedro</h1>
        <h1 class="cdsp1" alt="Icon">Student Information and Monitoring System</h1>
      </a>
    </div>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </nav>
  <!-- Navbar End -->

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category" style="text-align:center; font-size: 20px;">ADMIN</li>
          <!-- item 1 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" href="../admin/dashboard.php">
              <i class="menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!-- item 2 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" href="../admin/addStudent.php">
              <i class="menu-icon"></i>
              <span class="menu-title">Add Student</span>
            </a>
          </li>
          <!-- item 3 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#records" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon"></i>
              <span class="menu-title">Records</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="records">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="../admin/editgrades.php">Grades</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/student.php">Student Information</a></li>
              </ul>
            </div>
          </li>
          <!-- item 4 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reports">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="../admin/dailyReports.php">Daily Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/monthlyReports.php">Monthly Reports</a></li>
              </ul>
            </div>
          </li>
          <!-- item 5 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#faculty" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon"></i>
              <span class="menu-title">Faculty</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="faculty">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="../admin/addFaculty.php">Add Faculty</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/faculty.php">Faculty</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/editlearningareas.php">Assign Faculty</a></li>
              </ul>
            </div>
          </li>
          <!-- item 6 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" href="index.html">
              <i class="menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                    <h2 class="fw-bold text-primary text-uppercase">Student Information</h2>
                  </div>
                </div>
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Profile Information</h4>
                      <form class="forms-sample">
                        <div class="form-group">
                          <label>Profile Picture</label>
                          <input type="file" name="img[]" class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" id="exampleInputName1" placeholder="last name, first name, iddle name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Full Address</label>
                          <input type="text" class="form-control" id="exampleInputName1" placeholder="address">
                        </div>
                        <div class="form-group">
                          <label for="exampleSelectGender">Gender</label>
                          <select class="form-control" id="exampleSelectGender">
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Birthdate</label>
                          <input type="text" class="form-control" id="exampleInputName1" placeholder="birthdate">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Mother</label>
                          <input type="text" class="form-control" id="exampleInputName1" placeholder="gender">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">father</label>
                          <input type="text" class="form-control" id="exampleInputName1" placeholder="gender">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail3">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword4">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                        <button class="btn btn-light">Cancel</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-body footer mt-5 pt-5 px-0 wow fadeIn" data-wow-delay="0.1s">
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

  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

  <!-- JavaScript Libraries -->


  <!-- Template Javascript -->
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/admin/vendor.bundle.base.js"></script>
  <script src="../assets/js/admin/js/off-canvas.js"></script>
</body>

</html>