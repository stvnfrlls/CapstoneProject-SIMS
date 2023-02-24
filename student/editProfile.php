<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['SR_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
  $studentInfo = $getstudentInfo->fetch_assoc();

  $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ". " . $studentInfo['SR_suffix'];

  $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$studentInfo['SR_section']}'");
  $SectionInfo = $getSectionInfo->fetch_assoc();

  $getAdvisorInfo = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$SectionInfo['S_adviser']}'");
  $AdvisorInfo = $getAdvisorInfo->fetch_assoc();

  $getguardianInfo = $mysqli->query("SELECT * FROM guardian WHERE G_guardianOfStudent = '{$_SESSION['SR_number']}'");
  $guardianInfo = $getguardianInfo->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Student - Profile</title>
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

  <section>
    <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
      <h5 class="fw-bold text-primary text-uppercase" style="font-size: 30px; margin-top:50px;">Edit Profile</h5>
    </div>
    <div class="container py-5">
      <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        <div class="row">
          <div class="col-lg-10" style="margin: auto;">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Email Address</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_email" value="<?php echo $studentInfo['SR_email'] ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Enter Password</p>
                    <input type="hidden" class="form-control" name="SR_number" value="<?php echo $studentInfo['SR_number'] ?>">
                  </div>
                  <div class="col-sm-3">
                    <p class="text-muted mb-0"><input type="password" class="form-control" name="SR_password"></p>
                  </div>
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Confirm Password</p>
                  </div>
                  <div class="col-sm-3">
                    <p class="text-muted mb-0"><input type="password" class="form-control" name="Confirm_password"></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Profile Picture</p>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input type="file" class="form-control file-upload-info" placeholder="Upload Image">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">First Name</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_fname" value="<?php echo $studentInfo['SR_fname']; ?>"></p>
                  </div>
                  <div class="col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Middle Name</p>
                  </div>
                  <div class="col-sm-3">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_mname" value="<?php echo $studentInfo['SR_mname']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Last Name</p>
                  </div>
                  <div class="col-sm-6">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_lname" value="<?php echo $studentInfo['SR_lname']; ?>"></p>
                  </div>
                  <div class="col-sm-1" style="padding-top:11px;">
                    <p class="mb-0">Suffix</p>
                  </div>
                  <div class="col-sm-2">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_suffix" value="<?php echo $studentInfo['SR_suffix']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Age</p>
                  </div>
                  <div class="col-sm-2">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_age" value="<?php echo $studentInfo['SR_age']; ?>"></p>
                  </div>
                  <div class="col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Gender</p>
                  </div>
                  <div class="col-sm-5">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_gender" value="<?php echo $studentInfo['SR_gender']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Birthdate</p>
                  </div>
                  <div class="col-sm-3">
                    <p class="text-muted mb-0"><input type="date" class="form-control" name="SR_birthday" value="<?php echo date('Y-m-d', strtotime($studentInfo['SR_birthday'])); ?>"></p>
                  </div>
                  <div class="col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Birthplace</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_birthplace" value="<?php echo $studentInfo['SR_birthplace']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Religion</p>
                  </div>
                  <div class="col-sm-3">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_religion" value="<?php echo $studentInfo['SR_religion']; ?>"></p>
                  </div>
                  <div class="col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Citizenship</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_citizenship" value="<?php echo $studentInfo['SR_citizenship']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Address</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_address" value="<?php echo $studentInfo['SR_address']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class=" row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Barangay</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_barangay" value="<?php echo $studentInfo['SR_barangay']; ?>"></p>
                  </div>
                  <div class=" col-sm-1" style="padding-top:11px;">
                    <p class="mb-0">City</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_city" value="<?php echo $studentInfo['SR_city']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class=" row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Province</p>
                  </div>
                  <div class="col-sm-5">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_state" value="<?php echo $studentInfo['SR_state']; ?>"></p>
                  </div>
                  <div class=" col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Postal Code</p>
                  </div>
                  <div class="col-sm-2">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="SR_postal" value="<?php echo $studentInfo['SR_postal']; ?>"></p>
                  </div>
                </div>
              </div>
            </div>
            <div class=" card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">First Name</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_fname" value="<?php echo $guardianInfo['G_fname']; ?>"></p>
                  </div>
                  <div class="col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Middle Name</p>
                  </div>
                  <div class="col-sm-3">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_mname" value="<?php echo $guardianInfo['G_mname']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Last Name</p>
                  </div>
                  <div class="col-sm-6">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_lname" value="<?php echo $guardianInfo['G_lname']; ?>"></p>
                  </div>
                  <div class="col-sm-1" style="padding-top:11px;">
                    <p class="mb-0">Suffix</p>
                  </div>
                  <div class="col-sm-2">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_suffix" value="<?php echo $guardianInfo['G_suffix']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Relationship to Student</p>
                  </div>
                  <div class="col-sm-3">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_relationshipStudent" value="<?php echo $guardianInfo['G_relationshipStudent']; ?>"></p>
                  </div>
                  <div class="col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Email Address</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_email" value="<?php echo $guardianInfo['G_email']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Telephone Number</p>
                  </div>
                  <div class="col-sm-3">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_telephone" value="<?php echo $guardianInfo['G_telephone']; ?>"></p>
                  </div>
                  <div class="col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Contact Number</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_contact" value="<?php echo $guardianInfo['G_contact']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Address</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_address" value="<?php echo $guardianInfo['G_address']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Barangay</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_barangay" value="<?php echo $guardianInfo['G_barangay']; ?>"></p>
                  </div>
                  <div class="col-sm-1" style="padding-top:11px;">
                    <p class="mb-0">City</p>
                  </div>
                  <div class="col-sm-4">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_city" value="<?php echo $guardianInfo['G_city']; ?>"></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3" style="padding-top:11px;">
                    <p class="mb-0">Province</p>
                  </div>
                  <div class="col-sm-5">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_state" value="<?php echo $guardianInfo['G_state']; ?>"></p>
                  </div>
                  <div class="col-sm-2" style="padding-top:11px;">
                    <p class="mb-0">Postal Code</p>
                  </div>
                  <div class="col-sm-2">
                    <p class="text-muted mb-0"><input type="text" class="form-control" name="G_postal" value="<?php echo $guardianInfo['G_postal']; ?>"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="text-align: center;">
          <button type="submit" class="btn btn-primary me-2" name="editStudentProfile">Save</button>
          <button class="btn btn-light" onclick="location.href='../student/profile.php'">Back</button>
        </div>
      </form>
    </div>
  </section>

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

  <script src="../assets/js/eduwell/isotope.min.js"></script>
  <script src="../assets/js/eduwell/owl-carousel.js"></script>
  <script src="../assets/js/eduwell/lightbox.js"></script>
  <script src="../assets/js/eduwell/tabs.js"></script>
  <script src="../assets/js/eduwell/video.js"></script>
  <script src="../assets/js/eduwell/slick-slider.js"></script>
  <script src="../assets/js/eduwell/custom.js"></script>
  <script src="../assets/js/startup/main.js"></script>

  <script src="../assets/js/educ/vendor/jquery-2.2.4.min.js"></script>
  <script src="../assets/js/educ/vendor/bootstrap.min.js"></script>
  <script src="../assets/js/educ/easing.min.js"></script>
  <script src="../assets/js/educ/hoverIntent.js"></script>
  <script src="../assets/js/educ/superfish.min.js"></script>
  <script src="../assets/js/educ/jquery.ajaxchimp.min.js"></script>
  <script src="../assets/js/educ/jquery.magnific-popup.min.js"></script>
  <script src="../assets/js/educ/jquery.tabs.min.js"></script>
  <script src="../assets/js/educ/jquery.nice-select.min.js"></script>
  <script src="../assets/js/educ/owl.carousel.min.js"></script>
  <script src="../assets/js/educ/mail-script.js"></script>
  <script src="../assets/js/educ/main.js"></script>

</body>

</html>