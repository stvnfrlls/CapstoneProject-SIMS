<?php
require_once("../assets/php/server.php");
include('../assets/phpqrcode/qrlib.php');

if (!isset($_SESSION['SR_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
  $studentInfo = $getstudentInfo->fetch_assoc();

  $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ". " . $studentInfo['SR_suffix'];

  $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$studentInfo['SR_section']}' AND acadYear = '{$currentSchoolYear}'");
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

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="../assets/css/sweetAlert.css" rel="stylesheet">

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
    <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
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
          <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown" style="color: white; font-size: 14px;">Menu <i class="fa fa-caret-down"></i></a>
          <div class="dropdown-menu bg-dark border-0 m-0">
            <a href="../student/dashboard.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Dashboard</a>
            <a href="../student/profile.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Profile</a>
            <a href="../student/grades.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Grades</a>
            <a href="../student/dailyAttendance.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Attendance</a>
            <a href="../student/reminders.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Reminders</a>
            <a href="../student/announcement.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">School Announcements</a>
            <a href="../auth/logout.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Logout</a>
          </div>
        </div>
        <a href="" class="nav-item nav-link" style="color: white; font-size: 14px;">Faculty Directory</a>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <section>
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <?php
              if (empty($studentInfo['SR_profile_img'])) { ?>
                <img src="../assets/img/profile.png" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
              <?php } else { ?>
                <img src="../assets/img/profile/<?php echo $studentInfo['SR_profile_img'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
              <?php }
              ?>
              <h5 class="my-3"><?php echo $Student_Fullname ?></h5>
              <p class="text-muted mb-1"><?php echo $studentInfo['SR_number'] ?></p>
              <p class="text-muted mb-4"><?php echo $studentInfo['SR_grade'] . " - " . $studentInfo['SR_section'] ?></p>
              <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-outline-primary ms-1" onclick="location.href='../student/editProfile.php'">Edit</button>
                <button type="button" class="btn btn-outline-primary ms-1" onclick="openImage()">View QR Code</button>
              </div>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <p class="mb-4" style="text-align: center; color:#c02628;">Class Adviser</p>
              <p class="mb-1" style="font-size: .90rem; text-align: center;">
                <?php
                if (mysqli_num_rows($getAdvisorInfo) > 0) {
                  echo $AdvisorInfo['F_lname'] .  ", " . $AdvisorInfo['F_fname'] . " " . substr($AdvisorInfo['F_mname'], 0, 1) . ". " . $AdvisorInfo['F_suffix'];
                } else {
                  echo "Advisor not yet assigned";
                }
                ?>
              </p>

            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <p class="mb-4" style="text-align: center; color:#c02628;">Class Schedule</p>
              <?php
              $getSchedule = $mysqli->query("SELECT * FROM workschedule WHERE SR_section = '{$studentInfo['SR_section']}'");
              if (mysqli_num_rows($getSchedule) > 0) {
                while ($Schedule = $getSchedule->fetch_assoc()) { ?>
                  <p class="mb-1" style="font-size: .90rem;"><?php echo $Schedule['S_subject'] ?></p>
                  <div class="progress rounded" style="height: 25px;">
                    <p style="font-size: .77rem; margin: 5px 0px 0px 7px">MONDAY-FRIDAY (<?php echo $Schedule['WS_start_time'] . " - " . $Schedule['WS_end_time'] ?>)</p>
                  </div>
                <?php }
              } else { ?>
                <div class="progress rounded" style="height: 25px;">
                  <p style="font-size: .77rem; margin: 5px 0px 0px 7px; text-align: center;">NO DATA</p>
                </div>
              <?php }
              ?>
            </div>
          </div>
          <div class="card mb-4 mb-md-0">
            <div class="card-body">
              <p class="mb-4" style="text-align: center; color:#c02628;">Fetchers</p>
              <div class="accordion-left">
                <dl class="accordion">
                  <dt>
                    <a href="" style="font-size: 15px"> > Ricardo Dalisay</a>
                  </dt>
                  <dd>
                    <h7>Contact Number: 0987 930 4832</h7>
                    <p>Email Address: juandelacruz@gmail.com</p>
                  </dd>
                  <dt>
                    <a href="" style="font-size: 15px"> > Juan Dela Cruz</a>
                  </dt>
                  <dd>
                    <h7>Contact Number: 0987 930 4832</h7>
                    <p>Email Address: juandelacruz@gmail.com</p>
                  </dd>
                  <dt>
                    <a href="" style="font-size: 15px"> > Lolong</a>
                  </dt>
                  <dd>
                    <h7>Contact Number: 0987 930 4832</h7>
                    <p>Email Address: juandelacruz@gmail.com</p>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $Student_Fullname ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Age</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $studentInfo['SR_age'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Gender</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $studentInfo['SR_gender'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Birthdate</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $studentInfo['SR_birthday'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Birthplace</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $studentInfo['SR_birthplace'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Religion</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $studentInfo['SR_religion'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Citizenship</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $studentInfo['SR_citizenship'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo  $studentInfo['SR_address'] .  ", " . $studentInfo['SR_barangay'] . " " . $studentInfo['SR_city'] . ". " . $studentInfo['SR_state'] . " (" . $studentInfo['SR_postal'] . ")" ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Guardian</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php
                    if (!isset($guardianInfo['G_lname'])) {
                      echo "";
                    } else {
                      echo $guardianInfo['G_lname'] .  ", " . $guardianInfo['G_fname'] . " " . substr($guardianInfo['G_mname'], 0, 1) . ". " . $guardianInfo['G_suffix'];
                    }
                    ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $studentInfo['SR_email'] ?></p>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Guardian Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php
                    if (!isset($guardianInfo['G_lname'])) {
                      echo "";
                    } else {
                      echo $guardianInfo['G_lname'] .  ", " . $guardianInfo['G_fname'] . " " . substr($guardianInfo['G_mname'], 0, 1) . ". " . $guardianInfo['G_suffix'];
                    }
                    ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Relationship to Student</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php
                    if (!isset($guardianInfo['G_relationshipStudent'])) {
                      echo "";
                    } else {
                      echo $guardianInfo['G_relationshipStudent'];
                    }
                    ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php
                    if (!isset($guardianInfo['G_email'])) {
                      echo "";
                    } else {
                      echo $guardianInfo['G_email'];
                    }
                    ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Telephone Number</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php
                    if (!isset($guardianInfo['G_telephone'])) {
                      echo "";
                    } else {
                      echo $guardianInfo['G_telephone'];
                    }
                    ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone Number</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php
                    if (!isset($guardianInfo['G_contact'])) {
                      echo "";
                    } else {
                      echo $guardianInfo['G_contact'];
                    }
                    ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php
                    if (!isset($guardianInfo['G_address'])) {
                      echo "";
                    } else {
                      echo $guardianInfo['G_address'] .  ", " . $guardianInfo['G_barangay'] . " " . $guardianInfo['G_city'] . ". " . $guardianInfo['G_state'] . " (" . $guardianInfo['G_postal'] . ")";
                    }
                    ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-body footer wow fadeIn" data-wow-delay="0.1s">
    <div class="container-fluid copyright" style="padding: 15px 0px 15px 0px;">
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

  <?php
  $getQRData = $mysqli->query("SELECT SR_number FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
  if (mysqli_num_rows($getQRData) == 1) {
    $QRData =  $getQRData->fetch_assoc();

    $tempDir = '../assets/temp/';
    if (!file_exists($tempDir)) {
      mkdir($tempDir);
    }
    $qrcode_data = $QRData['SR_number'];
    QRcode::png($qrcode_data,  $tempDir . '' . $qrcode_data . '.png', QR_ECLEVEL_L);
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
  <!-- <script>
    const viewQR = document.getElementById('viewQR');
    viewQR.addEventListener('click', function() {
      Swal.fire({
        imageUrl: '<?php echo "../assets/temp/" . $QRData['SR_number'] . ".png"; ?>',
      })
    })
  </script> -->
  <script>
    function openImage() {
      var width = window.innerWidth * 0.8; // calculate the width of the new window
      var height = window.innerHeight * 0.8; // calculate the height of the new window
      var left = (window.innerWidth - width) / 2; // calculate the horizontal position of the new window
      var top = (window.innerHeight - height) / 2; // calculate the vertical position of the new window
      var features = "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top; // specify the features of the new window
      var image = window.open("<?php echo "../assets/temp/" . $QRData['SR_number'] . ".png"; ?>", "Image", features); // open the new window and display the image inside it
    }
  </script>
</body>

</html>