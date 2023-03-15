<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'");
  if (mysqli_num_rows($getSectionInfo) > 0) {
    $ClassListRow = 1;

    $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'");
    $SectionData = $getSectionInfo->fetch_assoc();

    $getFacultyName = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$_SESSION['F_number']}'");
    $FacultyData = $getFacultyName->fetch_assoc();

    if (isset($_GET['SY'])) {
      $getSectionClassList = $mysqli->query("SELECT * FROM classlist 
                                            LEFT JOIN studentrecord 
                                            ON classlist.SR_number = studentrecord.SR_number
                                            WHERE classlist.SR_section = '{$SectionData['S_name']}' 
                                            AND classlist.acadYear = '{$_GET['SY']}' 
                                            ORDER BY studentrecord.SR_lname");
    } else {
      $getSectionClassList = $mysqli->query("SELECT * FROM classlist 
                                            LEFT JOIN studentrecord 
                                            ON classlist.SR_number = studentrecord.SR_number
                                            WHERE classlist.SR_section = '{$SectionData['S_name']}' 
                                            AND classlist.acadYear = '{$currentSchoolYear}'
                                            ORDER BY studentrecord.SR_lname");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Faculty - Advisory Class</title>
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

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="../assets/css/sweetAlert.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/form-style.css" rel="stylesheet">
  <link href="../assets/css/admin/style.css" rel="stylesheet">

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
                    <h2 class="fw-bold text-primary text-uppercase">Advisory Class</h2>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="  col-sm-12  col-lg-4 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <?php
                            if (mysqli_num_rows($getSectionInfo) > 0) { ?>
                              <h3>
                                <?php
                                if ($SectionData['S_yearLevel'] == 'KINDER') {
                                  echo $SectionData['S_yearLevel'] . " - " . $SectionData['S_name'];
                                } else {
                                  echo "Grade " . $SectionData['S_yearLevel'] . " - " . $SectionData['S_name'];
                                }

                                ?>
                              </h3>
                              <p style="margin-bottom: 5px;"><?php echo $FacultyData['F_lname'] . ", " . $FacultyData['F_fname'] . " " . substr($FacultyData['F_mname'], 0, 1); ?></p>
                              <p style="margin-bottom: 5px;">School Year: <?php echo $currentSchoolYear ?></p>
                            <?php } else { ?>
                              <h3>NO DATA</h3>
                              <p style="margin-bottom: 5px;">NO DATA</p>
                              <p style="margin-bottom: 5px;">School Year: NO DATA</p>
                            <?php }
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <div class="btn-group" style="margin-bottom: 15px;">
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
                                  $getAcadYear = $mysqli->query("SELECT DISTINCT(acadYear) FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'");
                                  while ($acadYearData = $getAcadYear->fetch_assoc()) {
                                    if ($acadYearData['acadYear'] != $currentSchoolYear) {
                                      echo '<a class="dropdown-item" href="advisoryPage.php?SY=' . $acadYearData['acadYear'] . '">' . $acadYearData['acadYear'] . '</a>';
                                    }
                                  }
                                  ?>
                                </div>
                              </div>
                            </div>
                            <div class="btn-group" style="float: right;">
                              <a href="" style="background-color: #e4e3e3; margin-right: 0px;" class="btn btn-secondary">Download <i class="fa fa-print" style="font-size: 12px; align-self:center;"></i></a>
                            </div>
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <style>
                                    .hatdog {
                                      border: 1px solid #ffffff;
                                      text-align: center;
                                      vertical-align: middle;
                                      height: 30px;
                                      color: #000000;
                                    }
                                  </style>
                                  <tr>
                                    <th class="hatdog">No.</th>
                                    <th class="hatdog">Student Number</th>
                                    <th class="hatdog">Student Name</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  if (mysqli_num_rows($getSectionInfo) > 0) {
                                    while ($SectionClassListData = $getSectionClassList->fetch_assoc()) { ?>
                                      <tr>
                                        <td class="hatdog"><?php echo $ClassListRow; ?></td>
                                        <td class="hatdog"><?php echo $SectionClassListData['SR_number']; ?></td>
                                        <td class="hatdog">
                                          <a href="viewStudent.php?ID=<?php echo $SectionClassListData['SR_number']; ?>">
                                            <?php
                                            $getStudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$SectionClassListData['SR_number']}'");
                                            $studentInfo = $getStudentInfo->fetch_assoc();

                                            echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ". " . $studentInfo['SR_suffix'];
                                            ?>
                                          </a>
                                        </td>
                                      </tr>
                                    <?php $ClassListRow++;
                                    }
                                  } else { ?>
                                    <tr>
                                      <td class="hatdog" colspan="3">NO DATA</td>
                                    </tr>
                                  <?php }
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