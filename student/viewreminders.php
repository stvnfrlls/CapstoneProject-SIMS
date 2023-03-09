<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['SR_number'])) {
  header('Location: ../auth/login.php');
} else {
  if (isset($_GET['ID'])) {
    $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
    $studentInfo = $getstudentInfo->fetch_assoc();
    $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$studentInfo['SR_section']}'");
    $SectionInfo = $getSectionInfo->fetch_assoc();
    $getReminderData = $mysqli->query("SELECT * FROM reminders WHERE forsection = '{$studentInfo['SR_section']}' AND reminderID = '{$_GET['ID']}'");
    $ReminderInfo = $getReminderData->fetch_assoc();
  } else {
    header('Location: reminders.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Reminders</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="../assets/img/favicon.png" rel="icon">

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
      <span class="fa fa-bars" style="color:white;"></span>
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
            <a href="../student/grades.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Report Card</a>
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

  <!-- Blog Start -->
  <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5">
        <!-- Blog list Start -->
        <div class="col-lg-8">
          <div class="row g-5">

            <div class="blog-item bg-light rounded overflow-hidden">
              <div class="p-4">
                <div class="right-content">
                  <div class="d-flex mb-3">
                    <small class="me-3">Subject: <?php echo $ReminderInfo['subject'] ?></small>
                    <small>Deadline: <?php echo $ReminderInfo['deadline'] ?></small>
                  </div>
                  <p><?php echo $ReminderInfo['msg'] ?></p>
                  <div class="text-button" style="text-align:right;">
                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                      <input type="hidden" name="author" value="<?php echo $ReminderInfo['author'] ?>">
                      <button type="submit" name="markAsDone" class="btn btn-primary">Mark as done</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- Blog list End -->

        <!-- Sidebar Start -->
        <div class="col-lg-4">

          <!-- Recent Post Start -->
          <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
            <div class="section-title section-title-sm position-relative pb-3 mb-4">
              <h3 class="mb-0" style="text-align:left;">Other Reminders</h3>
            </div>
            <?php
            $getReminderDataExcept = $mysqli->query("SELECT * FROM reminders WHERE forsection = '{$studentInfo['SR_section']}' AND reminderID != '{$_GET['ID']}'");
            if (mysqli_num_rows($getReminderDataExcept) > 0) {
              while ($OtherReminderInfo = $getReminderDataExcept->fetch_assoc()) { ?>
                <div class="d-flex rounded overflow-hidden mb-3">
                  <img class="img-fluid" src="../assets/img/about-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                  <a href="viewreminders.php?ID=<?php echo $OtherReminderInfo['reminderID'] ?>" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0"><?php echo $OtherReminderInfo['header'] ?></a>
                </div>
              <?php }
            } else { ?>
              <div class="d-flex rounded overflow-hidden mb-3">
                <img class="img-fluid" src="../assets/img/about-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                <a class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">
                  No More Reminders
                </a>
              </div>
            <?php }
            ?>
          </div>
          <!-- Recent Post End -->

          <!-- Image Start -->
          <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
            <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
          </div>
          <!-- Image End -->

        </div>
        <!-- Sidebar End -->
      </div>
    </div>
  </div>
  <!-- Blog End -->

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

</body>

</html>