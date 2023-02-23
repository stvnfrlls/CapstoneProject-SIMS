<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getWorkSchedule = $mysqli->query("SELECT SR_grade, SR_section, S_subject FROM workschedule WHERE F_number = '{$_SESSION['F_number']}'");
  $array_GradeSection = array();
  array_unshift($array_GradeSection, null);

  while ($dataWorkSchedule = $getWorkSchedule->fetch_assoc()) {
    $array_GradeSection[] = $dataWorkSchedule;
  }
  $current_url = $_SERVER["REQUEST_URI"];
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
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/form-style.css" rel="stylesheet">
  <link href="../assets/css/admin/style.css" rel="stylesheet">

</head>

<body>
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
    <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="fa fa-bars"></span>
    </button>
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
            <a class="nav-link" href="../faculty/createReminder.php">
              <i class=""></i>
              <span class="menu-title">Create Reminders</span>
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
              <span class="menu-title">Advisory</span>
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
                        <div class="card">
                          <div class="card-body">
                            <div style="margin-bottom: 30px;">
                              <div class="btn-group">
                                <div>
                                  <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">Academic Year
                                    <i class="fa fa-caret-down"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <a class="dropdown-item" href="">2022-2023</a>
                                    <a class="dropdown-item" href="">2023-2024</a>
                                    <a class="dropdown-item" href="">2024-2025</a>
                                  </div>
                                </div>
                              </div>
                              <button class="btn btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                <?php
                                if (isset($_GET['Grade']) && isset($_GET['Section'])) {
                                  echo "Grade " . $_GET['Grade'] . " - " . $_GET['Section'];
                                } else {
                                  echo "Grade and Section ";
                                }
                                ?>
                                <i class="fa fa-caret-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2" >
                                <?php
                                $rowCount = 1;
                                $GradeSectionRowCount = sizeof($array_GradeSection);
                                while ($rowCount != $GradeSectionRowCount) { ?>
                                  <a class="dropdown-item" href="<?php echo "classList.php?Grade=" . $array_GradeSection[$rowCount]['SR_grade'] . "&Section=" . $array_GradeSection[$rowCount]['SR_section']; ?>">
                                    <?php echo "Grade " . $array_GradeSection[$rowCount]['SR_grade'] . "-" . $array_GradeSection[$rowCount]['SR_section']; ?>
                                  </a>
                                <?php $rowCount++;
                                }
                                ?>
                              </div>
                              <div class="btn-group" style="float: right;">
                                <a href="" style="background-color: #e4e3e3; margin-right: 0px;" class="btn btn-secondary">Print <i class="fa fa-print" style="font-size: 12px; align-self:center;"></i></a>
                              </div>
                            </div>


                            <div class="table-responsive">
                              <table class="table table-striped table-class">
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
                                      $getClassList = "SELECT * FROM studentrecord WHERE SR_grade = '{$_GET['Grade']}'";
                                      $rungetClassList = $mysqli->query($getClassList);
                                      $rowCount = 1;
                                      while ($dataClassList = $rungetClassList->fetch_assoc()) { ?>
                                        <tr>
                                          <td><?php echo $rowCount ?></td>
                                          <td><?php echo $dataClassList['SR_number'] ?></td>
                                          <td>
                                            <a href="viewstudent.php?ID=<?php echo $dataClassList['SR_number'] ?>">
                                              <?php echo $dataClassList['SR_lname'] . ", " . $dataClassList['SR_fname'] . " " . substr($dataClassList['SR_mname'], 0, 1); ?>
                                            </a>
                                          </td>
                                        </tr>
                                    <?php
                                        $rowCount++;
                                      }
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
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-3 col-md-6">
          <h3 class="text-light mb-4">Address</h3>
          <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Phase 1A, Pacita Complex 1, San Pedro City, Laguna 4023</p>
          <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+63 919 065 6576</p>
          <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>customerservice@cdsp.edu.ph</p>
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


  <!-- Template Javascript -->
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/admin/vendor.bundle.base.js"></script>
  <script src="../assets/js/admin/off-canvas.js"></script>
  <script src="../assets/js/admin/file-upload.js"></script>

</body>

</html>