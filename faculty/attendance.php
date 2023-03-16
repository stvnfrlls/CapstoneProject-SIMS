<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Subject Attendance Report</title>
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
  <link href="../assets/css/dashboard-admin.css" rel="stylesheet">
  <link href="../assets/css/form-style.css" rel="stylesheet">
  <link href="../assets/css/admin/style.css" rel="stylesheet">
  <link href="../assets/css/admin/style.css.map" rel="stylesheet">


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
          <li class="nav-item">
            <a class="nav-link" href="../faculty/announcement.php">
              <i class=""></i>
              <span class="menu-title">School Announcements</span>
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
                    <h2 class="fw-bold text-primary text-uppercase">Subject Attendance Report</h2>
                    <p>DATE: <?php echo date('D M-d-Y') ?></p>
                  </div>
                </div>
                <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                  <nav class="nav">
                    <a class="nav-link" href="dailyReports.php">Daily</a>
                    <a class="nav-link" href="monthlyReports.php">Monthly</a>
                    <a class="nav-link active ms-0" href="attendance.php" style="color: #c02628;">Subject Attendance Report</a>
                    <a class="nav-link" href="advisoryAttendance.php">Advisory Attendance</a>
                    <a class="nav-link" href="advisoryConcern.php">Advisory Concern</a>
                  </nav>
                  <div class="border-bottom"></div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="btn-group">
                          <div>
                            <button class="btn btn-secondary" style="background-color: #e4e3e3;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              <?php
                              if (isset($_GET['section']) && isset($_GET['subject'])) {
                                echo "Section: " . $_GET['section'] . " - " . $_GET['subject'] . "  ";
                              } else {
                                echo "Grade - Section : Subject ";
                              }
                              ?><i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                              <?php
                              $getworkSchedule = $mysqli->query("SELECT S_subject, SR_grade, SR_section FROM workschedule WHERE acadYear = '{$currentSchoolYear}' AND F_number = '{$_SESSION['F_number']}'");
                              if (mysqli_num_rows($getworkSchedule) > 0) {
                                while ($workSchedule = $getworkSchedule->fetch_assoc()) { ?>
                                  <a class="dropdown-item" href="attendance.php?section=<?php echo $workSchedule['SR_section'] ?>&subject=<?php echo $workSchedule['S_subject'] ?>">
                                    <?php
                                    if ($workSchedule['SR_grade'] == "KINDER") {
                                      echo $workSchedule['SR_grade'] . " - " . $workSchedule['SR_section'] . " - " . $workSchedule['S_subject'];
                                    } else {
                                      echo "Grade " . $workSchedule['SR_grade'] . " - " . $workSchedule['SR_section'] . " - " . $workSchedule['S_subject'];
                                    }
                                    ?>
                                  </a>
                                <?php }
                              } else { ?>
                                <a class="dropdown-item" href="attendance.php">No schedule assigned</a>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 grid-margind">
                              <div class="card">
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>No.</th>
                                          <th>Student Name</th>
                                          <th>Date</th>
                                          <th>Time</th>
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
                                        $rowCount = 1;
                                        if (isset($_GET['section']) && isset($_GET['subject'])) {
                                          $getclasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN 
                                                                            (SELECT SR_number FROM classlist 
                                                                            WHERE acadYear = '{$currentSchoolYear}' 
                                                                            AND F_number = '{$_SESSION['F_number']}'
                                                                            AND SR_section = '{$_GET['section']}')
                                                                            ORDER BY SR_lname");
                                          if (mysqli_num_rows($getclasslistData) > 0) {
                                            while ($classlist = $getclasslistData->fetch_assoc()) { ?>
                                              <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="attendanceReportForm">
                                                <tr>
                                                  <td><?php echo $rowCount; ?></td>
                                                  <td>
                                                    <?php
                                                    $getStudentName = $mysqli->query("SELECT SR_lname, SR_fname, SR_mname, SR_suffix FROM studentrecord 
                                                                                  WHERE SR_number = '{$classlist['SR_number']}'");
                                                    $studentInfo = $getStudentName->fetch_assoc();
                                                    if (!empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] != "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
                                                      echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ".";
                                                    } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && !empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] != "") {
                                                      echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . $studentInfo['SR_suffix'];
                                                    } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
                                                      echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'];
                                                    }
                                                    ?>
                                                    <input type="hidden" name="SR_number" value="<?php echo $classlist['SR_number'] ?>">
                                                    <input type="hidden" name="SR_grade" value="<?php echo $classlist['SR_grade'] ?>">
                                                    <input type="hidden" name="SR_section" value="<?php echo $classlist['SR_section'] ?>">
                                                  </td>
                                                  <?php

                                                  ?>
                                                  <td><input type="date" class="form-control" name="RP_reportDate" required></td>
                                                  <td>
                                                    <?php
                                                    $getSubjectStartTime = $mysqli->query("SELECT WS_start_time FROM workschedule 
                                                                                        WHERE acadYear = '{$currentSchoolYear}'
                                                                                        AND S_subject = '{$_GET['subject']}'
                                                                                        AND F_number = '{$_SESSION['F_number']}'");
                                                    $SubjectStartTime = $getSubjectStartTime->fetch_assoc();
                                                    ?>
                                                    <input type="time" class="form-control" name="RP_reportTime" value="<?php echo $SubjectStartTime['WS_start_time'] ?>" readonly>
                                                  </td>
                                                  <td>
                                                    <select name="RP_attendanceReport" class="form-select" required>
                                                      <option selected></option>
                                                      <option value="LATE">Late</option>
                                                      <option value="ABSENT">Absent</option>
                                                      <option value="EXCUSED">Excused</option>
                                                      <option value="CUTTING">Skip Class</option>
                                                    </select>
                                                  </td>
                                                  <td>
                                                    <button type="submit" class="btn btn-primary" name="attendanceReportButton">SUBMIT</button>
                                                  </td>
                                                </tr>
                                              </form>
                                            <?php
                                              $rowCount++;
                                            }
                                          } else { ?>
                                            <tr>
                                              <td colspan="6" style="text-align: center;">No data available</td>
                                            </tr>
                                          <?php
                                          }
                                        } else { ?>
                                          <tr>
                                            <td colspan="6" style="text-align: center;">Select grade and section first</td>
                                          </tr>
                                        <?php
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

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script>
      const attendanceReportForm = document.getElementById('attendanceReportForm');
      const attendanceReportButton = document.getElementById('attendanceReportButton');
      attendanceReportButton.addEventListener('click', function() {
        Swal.fire({
          title: 'Are you sure you want to proceed with this action?',
          showCancelButton: true,
          confirmButtonText: 'Yes',
          cancelButtonText: `No`,
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Form submitted!',
              icon: 'success',
            }).then(() => {
              attendanceReportForm.submit();
            });
          }
        })
      })
    </script> -->
</body>

</html>