<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getfacultyinfo = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$_SESSION['F_number']}'");
  $facultyInfo = $getfacultyinfo->fetch_assoc();

  $getSubjects = $mysqli->query("SELECT * FROM workschedule WHERE F_number = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}'");

  $getGradeSection = $mysqli->query("SELECT * FROM workschedule WHERE F_number = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}'");

  $getReminderInfo = $mysqli->query("SELECT * FROM reminders WHERE reminderID = '{$_GET['ID']}' AND author = '{$_SESSION['F_number']}'");
  $reminderInfo = $getReminderInfo->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Faculty - Edit Reminder</title>
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

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="../assets/css/sweetAlert.css" rel="stylesheet">

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
  <nav class="fixed-top align-items-top">
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
      <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="fa fa-bars"></span>
      </button>
    </nav>
  </nav>
  <!-- Navbar End -->

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item" style="text-align:center; font-size: 20px; color: #b9b9b9; margin-top:20px;">FACULTY</li>
          <!-- line 1 -->
          <li class="nav-item nav-category">Profile</li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/dashboard.php">
              <i class=""></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/viewProfile.php">
              <i class=""></i>
              <span class="menu-title">View Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/reminders.php">
              <i class=""></i>
              <span class="menu-title">Reminders</span>
            </a>
          </li>
          <!-- line 2 -->
          <li class="nav-item nav-category">Menu</li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/scanQR.php">
              <i class=""></i>
              <span class="menu-title">Scan QR</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/advisoryPage.php">
              <i class=""></i>
              <span class="menu-title">Advisory Class</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/classList.php">
              <i class=""></i>
              <span class="menu-title">Class List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/encodegrades.php">
              <i class=""></i>
              <span class="menu-title">Encode Grades</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/studentStatus.php">
              <i class=""></i>
              <span class="menu-title">Student Status</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../faculty/dailyReports.php">
              <i class=""></i>
              <span class="menu-title">Attendance Report</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../auth/logout.php">
              <i class=""></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="reminderForm">
            <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                      <h2 class="fw-bold text-primary text-uppercase">Create Reminders</h2>
                    </div>
                  </div>
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-12 grid-margin">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Create Reminders</h4>
                              <div class="row">
                                <div class="row g-3">
                                  <div class="col-md-6">
                                    <div class="form-floating">
                                      <input type="hidden" name="author" value="<?php echo $facultyInfo['F_number'] ?>">
                                      <input type="text" class="form-control" id="name" value="<?php echo $facultyInfo['F_lname'] .  ", " . $facultyInfo['F_fname'] . " " . substr($facultyInfo['F_mname'], 0, 1) ?>" readonly>
                                      <label for="name">Your Name</label>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-floating">
                                      <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d', strtotime($reminderInfo['deadline'])) ?>" required>
                                      <label for="email">Deadline</label>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-floating">
                                      <select class="form-select" name="forsection" id="forsection" required>
                                        <?php
                                        if (!empty($reminderInfo['forsection'])) {
                                          echo '<option selected>' . $reminderInfo['forsection'] . '</option>';
                                        } else {
                                          echo '<option selected></option>';
                                        }
                                        ?>
                                        <?php
                                        if (mysqli_num_rows($getGradeSection) > 0) {
                                          while ($GradeSection = $getGradeSection->fetch_assoc()) { ?>
                                            <option value="<?php echo $GradeSection['SR_section'] ?>"><?php echo $GradeSection['SR_section'] . " - " . $GradeSection['S_subject'] . " (" . $GradeSection['WS_start_time'] . " - " . timePlusOneMinute($GradeSection['WS_end_time']) . ")"  ?></option>
                                          <?php
                                          }
                                        } else { ?>
                                          <option selected>No assigned section</option>
                                        <?php }
                                        ?>
                                      </select>
                                      <label for="forsection">Grade and Section</label>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-floating">
                                      <select class="form-select" name="subject" id="subject" placeholder="Subject" required>
                                        <?php
                                        if (!empty($reminderInfo['subject'])) {
                                          echo '<option selected>' . $reminderInfo['subject'] . '</option>';
                                        } else {
                                          echo '<option selected></option>';
                                        }
                                        ?>
                                        <?php
                                        if (mysqli_num_rows($getSubjects) > 0) {
                                          while ($subjects = $getSubjects->fetch_assoc()) { ?>
                                            <option value="<?php echo $subjects['S_subject'] ?>"><?php echo $subjects['S_subject'] . " - (" . $subjects['WS_start_time'] . " - " . timePlusOneMinute($subjects['WS_end_time']) . ")"  ?></option>
                                          <?php
                                          }
                                        } else { ?>
                                          <option selected>No subjects available</option>
                                        <?php }
                                        ?>
                                      </select>
                                      <label for="subject">Subject</label>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-floating">
                                      <textarea class="form-control" id="message" name="MSG" style="height: 200px" required><?php echo $reminderInfo['msg'] ?></textarea>
                                      <label for="message">Details</label>
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
                </div>
              </div>
              <div style="text-align: center;">
                <input type="hidden" name="updateReminder" value="submit">
                <button type="button" id="updateReminder" class="btn btn-primary me-2">Update Reminder</button>
                <button type="button" class="btn btn-light" onclick="location.href='../faculty/viewReminders.php'">Cancel</button>
              </div>
            </div>
          </form>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

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

  <!-- Template Javascript -->
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/admin/vendor.bundle.base.js"></script>
  <script src="../assets/js/admin/off-canvas.js"></script>
  <script src="../assets/js/admin/file-upload.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
  <script>
    const updateReminder = document.getElementById('updateReminder');
    const reminderForm = document.getElementById('reminderForm');

    updateReminder.addEventListener('click', function() {
      Swal.fire({
        title: 'Are you sure you want to update this reminder?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          reminderForm.submit();
          Swal.fire({
            title: 'Successfully updated!',
            icon: 'success',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              window.location.href = '../faculty/reminders.php';
            }
          })
        }
      })
    })
  </script>
</body>

</html>