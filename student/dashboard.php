<?php
require_once("../assets/php/server.php");
include('../assets/phpqrcode/qrlib.php');

if (!isset($_SESSION['SR_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
  $studentInfo = $getstudentInfo->fetch_assoc();

  $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$studentInfo['SR_section']}' AND acadYear = '{$currentSchoolYear}'");
  $SectionInfo = $getSectionInfo->fetch_assoc();

  if (!empty($SectionInfo['S_adviser'])) {
    $getAdvisorInfo = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$SectionInfo['S_adviser']}'");
    $AdvisorInfo = $getAdvisorInfo->fetch_assoc();
  }
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
  <nav class="navbar navbar-expand-lg bg-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars" style="color: white;"></span>
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

  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="home-tab" style="margin-top: 0px !important;">

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
                                <?php
                                if (empty($studentInfo['SR_profile_img'])) { ?>
                                  <img src="../assets/img/profile.png" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
                                <?php } else { ?>
                                  <img src="../assets/img/profile/<?php echo $studentInfo['SR_profile_img'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
                                <?php }
                                ?>
                              </div>
                              <div class="col-8" style="align-self: center;">
                                <h3 style="margin-bottom: 8px;"><?php echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ". " . $studentInfo['SR_suffix']; ?></h3>
                                <p style="margin-bottom: 2px;"><?php echo $studentInfo['SR_number'] ?></p>
                                <p style="margin-bottom: 2px;"><?php echo "Grade " . $studentInfo['SR_grade'] . " - " . $studentInfo['SR_section'] ?></p>
                                <p style="margin-bottom: 2px;">
                                  <?php
                                  if (!empty($SectionInfo['S_adviser'])) {
                                    echo $AdvisorInfo['F_lname'] .  ", " . $AdvisorInfo['F_fname'] . " " . substr($AdvisorInfo['F_mname'], 0, 1) . ". " . $AdvisorInfo['F_suffix'];
                                  } else {
                                    echo "Advisor not yet assigned";
                                  }
                                  ?>
                                </p>
                                <p style="margin-bottom: 2px;"><?php echo "S.Y. " . $currentSchoolYear ?></p>
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
                              <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628;">
                                <?php
                                $getPresentAttendance = $mysqli->query("SELECT COUNT(*) AS presentDays FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND acadYear = '{$currentSchoolYear}'");
                                $CountPresent = $getPresentAttendance->fetch_assoc();

                                if (empty($CountPresent['presentDays'])) {
                                  echo "NONE";
                                } else {
                                  echo $CountPresent['presentDays'];
                                }
                                ?>
                              </h1>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-2 grid-margin" style="margin: auto;  padding-bottom: 20px;">
                        <div class="card" style="height: 150px; padding-top: 12px;">
                          <div class="card-body">
                            <p class="d-flex flex-shrink-0 align-items-center justify-content-center text-center">Total Days of Absent</p>
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                              <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628;">
                                <?php
                                $getAbsentAttendance = $mysqli->query("SELECT COUNT(*) AS absentDays FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                $CountAbsent = $getAbsentAttendance->fetch_assoc();

                                if (empty($CountAbsent['absentDays'])) {
                                  echo "NONE";
                                } else {
                                  echo $CountAbsent['absentDays'];
                                }
                                ?>
                              </h1>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-2 grid-margin" style="margin: auto;  padding-bottom: 20px;">
                        <div class="card" style="height: 150px; padding-top: 12px;">
                          <div class="card-body">
                            <p class="d-flex flex-shrink-0 align-items-center justify-content-center text-center">Total Days of Late</p>
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                              <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628;">
                                <?php
                                $getLateAttendance = $mysqli->query("SELECT COUNT(*) AS lateDays FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                $CountLate = $getLateAttendance->fetch_assoc();

                                if (empty($CountLate['lateDays'])) {
                                  echo "NONE";
                                } else {
                                  echo $CountLate['lateDays'];
                                }
                                ?>
                              </h1>
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
                          <p class="d-flex flex-shrink-0 text-center">Information about the user's account or identity.</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                            <h1 class="display-1 mb-n2" style="font-size:30px; color:#c02628; padding-bottom: 25px;"><i class="fa fa-qrcode"></i></h1>
                          </div>
                          <!-- <a id="viewQR"> -->
                          <a onclick="openImage()">

                            <h3 class="d-flex flex-shrink-0 align-items-center justify-content-center">QR Code</h3>
                          </a>
                          <p class="d-flex flex-shrink-0 text-center">A digital code that can be scanned for information.</p>
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
                          <p class="d-flex flex-shrink-0 text-center">Record of user's presence/absence in class/work.</p>
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
                          <p class="d-flex flex-shrink-0 text-center">Evaluation of a user's performance or achievement.</p>
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
                        <?php
                        $getReminderData = $mysqli->query("SELECT * FROM reminders WHERE forsection = '{$studentInfo['SR_section']}' AND acadYear = '{$currentSchoolYear}'");

                        if ($getReminderData->num_rows > 0) {
                          while ($reminders = $getReminderData->fetch_assoc()) { ?>
                            <div class="col-lg-4 col-sm-12 mb-3">
                              <div class="card">
                                <div class="card-body">
                                  <div class="user-details row">
                                    <?php
                                    $getAuthorInfo = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$reminders['author']}'");
                                    $AuthorInfo = $getAuthorInfo->fetch_assoc();
                                    ?>
                                    <p class="user-name col-12" style="text-align:center;">
                                      <?php echo $AuthorInfo['F_lname'] .  ", " . $AuthorInfo['F_fname'] . " " . substr($AuthorInfo['F_mname'], 0, 1) . ". " . $AuthorInfo['F_suffix']; ?>
                                      <span class="far fa-user" style="color: #c02628;"></span>
                                    </p>
                                    <p class="date col-12" style="text-align:center;">
                                      <a>
                                        <?php
                                        $storedDate = strtotime($reminders['date_posted']);
                                        echo date("D M/d/Y", $storedDate);
                                        ?>
                                      </a>
                                      <span class="fa fa-calendar" style="color: #c02628;"></span>
                                    </p>
                                  </div>
                                  <div class="col-12">
                                    <a class="posts-title" href="viewreminders.php?rmdID=<?php echo $reminders['reminderID'] ?>">
                                      <h3><?php echo $reminders['header'] ?></h3>
                                    </a>
                                    <p>Subject: <?php echo $reminders['subject'] ?></p>
                                    <p class="excert">
                                      <?php
                                      if (empty($reminders['msg'])) {
                                        echo "No description";
                                      } else {
                                        echo $reminders['msg'];
                                      }
                                      ?>
                                    </p>
                                    <div class="text-center">
                                      <a href="viewreminders.php?rmdID=<?php echo $reminders['reminderID'] ?>" class="primary-btn">View More</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php
                          }
                        } else { ?>
                          <div class="col mb-3">
                            <div class="card">
                              <div class="card-body text-center">
                                <p>No Reminder Yet</p>
                              </div>
                            </div>
                          </div>
                        <?php }
                        ?>
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
                      <?php
                      $getAnnouncementData = $mysqli->query("SELECT * FROM announcement");
                      if (mysqli_num_rows($getAnnouncementData) > 0) {
                        while ($announcement = $getAnnouncementData->fetch_assoc()) { ?>
                          <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                            <div class="blog-item bg-light rounded overflow-hidden">
                              <div class="p-4">
                                <div class="d-flex mb-3">
                                  <small class="me-3"><i class="far fa-user text-primary me-2"></i><?php echo $announcement['author']; ?></small>
                                  <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo $announcement['date']; ?></small>
                                </div>
                                <h4 class="mb-3"><?php echo $announcement['header']; ?></h4>
                                <p><?php echo $announcement['msg']; ?></p>
                                <a class="text-uppercase" href="viewannouncement.php?postID=<?php echo $announcement['ANC_ID']; ?>">Read More <i class="bi bi-arrow-right"></i></a>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        <section class="popular-courses-area courses-page">
                          <div style="text-align: center;">
                            <a href="#" class="primary-btn text-uppercase" style="width: auto;">View More School Announcements</a>
                          </div>
                        </section>
                      <?php } else { ?>
                        <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                          <div class="blog-item bg-light rounded overflow-hidden">
                            <div class="p-4 text-center">
                              <h4>NO ANNOUNCEMENT YET</h4>
                            </div>
                          </div>
                        </div>
                      <?php }
                      ?>
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
  <script src="../assets/js/admin/dashboard.js"></script>

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
    const viewQR = document.querySelector("#viewQR");

    viewQR.addEventListener("click", function() {
      Swal.fire({
        imageUrl: '<?php echo "../assets/temp/" . $QRData['SR_number'] . ".png"; ?>',
      })
    });
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