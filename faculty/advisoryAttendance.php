<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getSectionData = $mysqli->query("SELECT SR_number, SR_grade, SR_section FROM classlist 
                                          WHERE F_number = '{$_SESSION['F_number']}' 
                                          AND acadYear = '{$currentSchoolYear}'");
  $sectionData = $getSectionData->fetch_assoc();
  $getUnresolveNotification = $mysqli->query("SELECT * FROM attendance_student_report 
                                            WHERE SR_grade = '{$sectionData['SR_grade']}' 
                                            AND SR_section = '{$sectionData['SR_section']}'");
  if (mysqli_num_rows($getUnresolveNotification) > 0) {
    $reminderCounter = mysqli_num_rows($getUnresolveNotification);
    echo <<<EOT
      <script>
          document.addEventListener("DOMContentLoaded", function(event) { 
              swal.fire({
                  text: 'You have {$reminderCounter} resolve attendance issue',
                  showDenyButton: true,
                  confirmButtonText: 'View concerns',
                  denyButtonText: 'Not now',
              }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = 'advisoryConcern.php';
                  } else {
                    Swal.fire('Resolve issues when ready', '', 'info')
                  }
              });
          });
      </script>
    EOT;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Advisory Attendance</title>
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
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between">
                  <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                    <h2 class="fw-bold text-primary text-uppercase">Advisory Attendance</h2>
                    <p>DATE: <?php echo date('D M-d-Y') ?></p>
                  </div>
                </div>
                <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                  <nav class="nav">
                    <a class="nav-link" href="dailyReports.php">Daily</a>
                    <a class="nav-link" href="monthlyReports.php">Monthly</a>
                    <a class="nav-link" href="attendance.php">Attendance Report</a>
                    <a class="nav-link active ms-0" href="advisoryAttendance.php" style="color: #c02628;">Advisory Attendance</a>
                    <a class="nav-link" href="advisoryConcern.php">Advisory Concern</a>
                  </nav>
                  <div class="border-bottom"></div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margind">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>No.</th>
                                    <th>Student Name</th>
                                    <th>Attendance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <style>
                                    input[type='number'] {
                                      width: 50px;
                                    }

                                    /* Chrome, Safari, Edge, Opera */
                                    input::-webkit-outer-spin-button,
                                    input::-webkit-inner-spin-button {
                                      -webkit-appearance: none;
                                      margin: 0;
                                    }

                                    .tabledata {
                                      border: 1px solid #ffffff;
                                      text-align: center;
                                      vertical-align: middle;
                                      height: 30px;
                                      color: #000000;
                                    }
                                  </style>
                                  <?php
                                  $getAdvisoryClassData = $mysqli->query("SELECT SR_number, SR_grade, SR_section FROM classlist 
                                                                              WHERE F_number = '{$_SESSION['F_number']}' 
                                                                              AND acadYear = '{$currentSchoolYear}'");
                                  $row = 1;
                                  while ($advisoryClass = $getAdvisoryClassData->fetch_assoc()) { ?>
                                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                                      <tr>
                                        <td><?php echo $row ?></td>
                                        <td>
                                          <?php
                                          $getStudentName = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$advisoryClass['SR_number']}'");
                                          $studentInfo = $getStudentName->fetch_assoc();

                                          echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ". " . $studentInfo['SR_suffix'];
                                          ?>
                                          <input type="hidden" name="SR_number" value="<?php echo $advisoryClass['SR_number'] ?>">
                                        </td>
                                        <td>
                                          <?php
                                          $dateNow = date('Y-m-d');
                                          $getAttendanceNow = $mysqli->query("SELECT * FROM attendance WHERE acadYear = '{$currentSchoolYear}' AND A_date = '{$dateNow}' AND SR_number = '{$studentInfo['SR_number']}'");
                                          $attendanceData = $getAttendanceNow->fetch_assoc();

                                          if (isset($attendanceData['A_time_IN']) && isset($attendanceData['A_status'])) {
                                            echo $attendanceData['A_time_IN'] . ' - ' . $attendanceData['A_status'];
                                          } else if (empty($attendanceData['A_time_IN']) && isset($attendanceData['A_status'])) {
                                            echo "MANUALLY ADDED";
                                          } else {
                                            echo "NO DATA";
                                          }
                                          ?>
                                        </td>
                                        <td>
                                          <select class="form-select" name="AttendanceStatus" required>
                                            <?php
                                            if (isset($attendanceData['A_status'])) {
                                              echo '<option selected value=' . $attendanceData['A_status'] . '>' . $attendanceData['A_status'] . '</option>';
                                            } else {
                                              echo '<option selected></option>';
                                            }
                                            ?>
                                            <option value="LATE">Late</option>
                                            <option value="ABSENT">Absent</option>
                                            <option value="EXCUSED">Excused</option>
                                            <option value="CUTTING">Skip Class</option>
                                          </select>
                                        </td>
                                        <td><button class="btn btn-primary" name="updateAttendanceStatus">SET</button></td>
                                      </tr>
                                    </form>
                                  <?php
                                    $row++;
                                  }
                                  ?>

                                </tbody>
                              </table>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script>
      function sweetalert() {
        Swal.fire({
          text: 'No advisory class assigned',
          icon: 'error',
          confirmButtonText: 'OK',
        }).then((result) => {
          window.location.replace("./dashboard.php");
        })
      }
    </script>
    <?php
    $checkAdvisoryPermission = $mysqli->query("SELECT * FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'");
    if (mysqli_num_rows($checkAdvisoryPermission) == 0) {
      echo '<script>sweetalert();</script>';
    }
    ?>
</body>

</html>