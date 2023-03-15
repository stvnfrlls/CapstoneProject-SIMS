<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getWorkSchedule = $mysqli->query("SELECT DISTINCT SR_grade, SR_section FROM workschedule WHERE F_number = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}'");
  $array_GradeSection = array();
  array_unshift($array_GradeSection, null);

  while ($dataWorkSchedule = $getWorkSchedule->fetch_assoc()) {
    $array_GradeSection[] = $dataWorkSchedule;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Faculty - Class List</title>
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
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                    <h2 class="fw-bold text-primary text-uppercase">Class List</h2>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div style="margin-bottom: 30px;">
                          <div class="btn-group">
                            <div>
                              <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                <?php
                                if (isset($_GET['SY'])) {
                                  echo "School Year: " . $_GET['SY'];
                                } else {
                                  echo "School Year: " . $currentSchoolYear;
                                }
                                ?>
                                <i class="fa fa-caret-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <?php
                                $getAcadYears = $mysqli->query("SELECT DISTINCT acadYear FROM classlist WHERE F_number = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}'");
                                while ($acadYears = $getAcadYears->fetch_assoc()) {
                                  if ($acadYears['acadYear'] != $currentSchoolYear) {
                                    echo '<a class="dropdown-item" href="classList.php?SY=' . $acadYears['acadYear'] . '">' . $acadYears['acadYear'] . '</a>';
                                  }
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                          <button class="btn btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                            <?php
                            if (isset($_GET['Grade']) && isset($_GET['Section'])) {
                              if ($_GET['Grade'] == 'KINDER') {
                                echo $_GET['Grade'] . " - " . $_GET['Section'];
                              } else {
                                echo "Grade " . $_GET['Grade'] . " - " . $_GET['Section'];
                              }
                            } else {
                              echo "Grade and Section ";
                            }
                            ?>
                            <i class="fa fa-caret-down"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <?php
                            $rowCount = 1;
                            $GradeSectionRowCount = sizeof($array_GradeSection);
                            while ($rowCount != $GradeSectionRowCount) { ?>
                              <a class="dropdown-item" href="<?php echo "classList.php?Grade=" . $array_GradeSection[$rowCount]['SR_grade'] . "&Section=" . $array_GradeSection[$rowCount]['SR_section']; ?>">
                                <?php
                                if ($array_GradeSection[$rowCount]['SR_grade'] == "KINDER") {
                                  echo $array_GradeSection[$rowCount]['SR_grade'] . "-" . $array_GradeSection[$rowCount]['SR_section'];
                                } else {
                                  echo "Grade " . $array_GradeSection[$rowCount]['SR_grade'] . "-" . $array_GradeSection[$rowCount]['SR_section'];
                                }

                                ?>
                              </a>
                            <?php $rowCount++;
                            }
                            ?>
                          </div>
                          <div class="btn-group" style="float: right;">
                            <a href="" style="background-color: #e4e3e3; margin-right: 0px;" class="btn btn-secondary">Download <i class="fa fa-download" style="font-size: 12px; align-self:center;"></i></a>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-striped text-center">
                                <thead>
                                  <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Student Number</th>
                                    <th scope="col">Student Name</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                    <?php
                                    $array_values = array();
                                    $value = array();
                                    $rowCount = 1;
                                    $GradeSectionRowCount = sizeof($array_GradeSection);
                                    while ($rowCount != $GradeSectionRowCount) {
                                      $value[] = $array_GradeSection[$rowCount]['SR_grade'];
                                      $rowCount++;
                                    }
                                    if (!isset($_GET['Grade'])) { ?>
                                      <tr>
                                        <td colspan="3">NO SELECTED ACADEMIC YEAR AND GRADE AND SECTION</td>
                                      </tr>
                                      <?php
                                    } else {
                                      if (isset($_GET['SY'])) {
                                        $getClassList = $mysqli->query("SELECT * FROM classlist WHERE SR_grade = '{$_GET['Grade']}' AND SR_section = '{$_GET['Section']}' AND acadYear = '{$_GET['SY']}'");
                                      } else {
                                        $getClassList = $mysqli->query("SELECT * FROM classlist WHERE SR_grade = '{$_GET['Grade']}' AND SR_section = '{$_GET['Section']}' AND acadYear = '{$currentSchoolYear}'");
                                      }

                                      if (mysqli_num_rows($getClassList) > 0) {
                                        $rowCount = 1;
                                        while ($dataClassList = $getClassList->fetch_assoc()) { ?>
                                          <tr>
                                            <td><?php echo $rowCount ?></td>
                                            <td><?php echo $dataClassList['SR_number'] ?></td>
                                            <td>
                                              <?php
                                              $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$dataClassList['SR_number']}'");
                                              $studentInfo = $getstudentInfo->fetch_assoc();
                                              ?>
                                              <a href="viewStudent.php?ID=<?php echo $studentInfo['SR_number'] ?>">
                                                <?php
                                                if (!empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] != "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
                                                  echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ".";
                                                } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && !empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] != "") {
                                                  echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . $studentInfo['SR_suffix'];
                                                } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
                                                  echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'];
                                                }
                                                ?>
                                              </a>
                                            </td>
                                          </tr>
                                        <?php
                                          $rowCount++;
                                        }
                                      } else { ?>
                                        <tr>
                                          <td colspan="3">NO AVAILABLE DATA</td>
                                        </tr>
                                    <?php }
                                    }
                                    ?>
                                  </form>
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

</body>

</html>