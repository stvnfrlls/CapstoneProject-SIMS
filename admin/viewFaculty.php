<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['AD_number'])) {
  header('Location: ../auth/login.php');
} else {
  if (isset($_GET['F_number'])) {
    $F_number = $_GET['F_number'];
    $viewData = "SELECT * FROM faculty WHERE F_number = '{$F_number}'";
    $runviewData = $mysqli->query($viewData);
    $getFacultyData = $runviewData->fetch_assoc();
  } else {
    header('Location: faculty.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Faculty Information</title>
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
  <link href="../assets/css/admin/materialdesignicons.min.css" rel="stylesheet">

</head>

<body>
  <nav class="fixed-top align-items-top">
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
      <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="fa fa-bars"></span>
      </button>
    </nav>
  </nav>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item" style="text-align:center; font-size: 20px; color: #b9b9b9; margin-top:20px;">ADMIN</li>
          <!-- line 1 -->
          <li class="nav-item nav-category" style="color: #b9b9b9;">Menu</li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/dashboard.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/auditTrail.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Activity History</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/createAdmin.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Create Admin</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/announcement.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">School Announcements</span>
            </a>
          </li>
          <!-- line 2 -->
          <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Student Records</li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/addStudent.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Register Student</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/createFetcher.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Register Fetcher</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/student.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Student Information</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/editgrades.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Encode Grades</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/editSection.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Change Student Section</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/movingUp.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Status</span>
            </a>
          </li>
          <!-- line 3 -->
          <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Faculty</li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/addFaculty.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Register Faculty</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/faculty.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Faculty Records</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/assignAdvisory.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Advisory Class Assignment</span>
            </a>
          </li>
          <!-- line 4 -->
          <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Learning Areas</li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/editlearningareas.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Work Schedule Assignment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/modifyCurriculum.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Edit Curriculum</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/modifySection.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Edit Section</span>
            </a>
          </li>
          <!-- line 5 -->
          <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Attendance Report</li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/dailyReports.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Daily Reports</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/monthlyReports.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Monthly Reports</span>
            </a>
          </li>
          <!-- line 5 -->
          <li class="nav-item nav-category" style="padding-top: 10px;"></li>
          <li class="nav-item">
            <a class="nav-link" href="../auth/logout.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Logout</span>
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
                    <h2 class="fw-bold text-primary text-uppercase">Faculty Information</h2>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-lg-4 col-sm-12 grid-margin" style="margin: auto; margin-bottom: 30px;">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Profile</h4>
                            <div class="row" style="padding-bottom: 15px;">
                              <div class="col-md-12 col-sm-6" style="text-align: center; margin-bottom: 20px; margin-top: 10px;">
                                <img src="../assets/img/profile.png" alt="avatar" class="rounded-circle img-fluidr" style="width: 150px;">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Personal Information</h4>
                            <div class="row" style="padding-bottom: 15px;">
                              <div class="col-md-4">
                                <label class="col-sm-12 col-form-label">Last Name</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_lname" value="<?php echo $getFacultyData['F_lname'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <label class="col-sm-12 col-form-label">First Name</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_fname" value="<?php echo $getFacultyData['F_fname'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label class="col-sm-12 col-form-label">Middle Name</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_mname" value="<?php echo $getFacultyData['F_mname'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-1">
                                <label class="col-sm-12 col-form-label">Suffix</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_suffix" value="<?php echo $getFacultyData['F_suffix'] ?>" readonly>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <label class="col-sm-12 col-form-label">Age</label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" name="F_age" value="<?php echo $getFacultyData['F_age'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <label class="col-sm-12 col-form-label">Birthdate</label>
                                <div class="col-sm-12">
                                  <input type="date" class="form-control" name="F_birthday" value="<?php echo $getFacultyData['F_birthday'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <label class="col-sm-12 col-form-label">Gender</label>
                                <div class="col-sm-12">
                                  <select class="form-select" name="F_gender" disabled>
                                    <option selected><?php echo $getFacultyData['F_gender'] ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="NA">Prefer not to say</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <label class="col-sm-12 col-form-label">Religion</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" value="<?php echo $getFacultyData['F_religion'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <label class="col-sm-12 col-form-label">Citizenship</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" value="<?php echo $getFacultyData['F_citizenship'] ?>" readonly>
                                </div>
                              </div>
                            </div>

                            <div class="row" style="padding-bottom: 15px;">
                              <h4 class="card-title">Address</h4>
                              <div class="col-md-6">
                                <label label class="col-sm-12 col-form-label">Address</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_address" value="<?php echo $getFacultyData['F_address'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label label class="col-sm-12 col-form-label">Barangay</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_barangay" value="<?php echo $getFacultyData['F_barangay'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label label class="col-sm-12 col-form-label">City</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_city" value="<?php echo $getFacultyData['F_city'] ?>" readonly>
                                </div>
                              </div>
                            </div>

                            <div class="row" style="padding-bottom: 15px;">
                              <div class="col-md-4">
                                <label label class="col-sm-12 col-form-label">State</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_state" value="<?php echo $getFacultyData['F_state'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <label label class="col-sm-12 col-form-label">Postal Code</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_postal" value="<?php echo $getFacultyData['F_postal'] ?>" readonly>
                                </div>
                              </div>
                            </div>

                            <div class="row" style="padding-bottom: 15px;">
                              <div class="col-md-6">
                                <label label class="col-sm-12 col-form-label">Contact Number</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="F_contact" value="<?php echo $getFacultyData['F_contactNumber'] ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label label class="col-sm-12 col-form-label">Email Address</label>
                                <div class="col-sm-12">
                                  <input type="email" class="form-control" name="F_email" value="<?php echo $getFacultyData['F_email'] ?>" readonly>
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
              <a class="btn btn-primary me-2" href="editFaculty.php?F_number=<?php echo $_GET['F_number'] ?>">Edit</a>
              <button class="btn btn-light">Back</button>
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

  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

  <!-- JavaScript Libraries -->


  <!-- Template Javascript -->
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/admin/vendor.bundle.base.js"></script>
  <script src="../assets/js/admin/off-canvas.js"></script>
</body>

</html>