<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['AD_number'])) {
  header('Location: ../auth/login.php');
} else {
  if (isset($_GET['F_number'])) {
    $F_number = $_GET['F_number'];
    $FacultyInformation = "SELECT * FROM faculty WHERE F_number = '{$F_number}'";
    $resultFacultyInformation = $mysqli->query($FacultyInformation);
    $getFacultyData = $resultFacultyInformation->fetch_assoc();
  } else {
    header('Location: faculty.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Edit Faculty Information</title>
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
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
    <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:400px;" alt="Icon">
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </nav>
  <!-- Navbar End -->

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
            <a class="nav-link" href="../admin/createAdmin.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Create Admin</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/addStudent.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Add Student</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/announcement.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Announcements</span>
            </a>
          </li>
          <!-- line 2 -->
          <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Student</li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/student.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Student Records</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/editgrades.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Grades</span>
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
              <span class="menu-title" style="color: #b9b9b9;">Add Faculty</span>
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
              <span class="menu-title" style="color: #b9b9b9;">Assign Advisory</span>
            </a>
          </li>
          <!-- line 4 -->
          <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Learning Areas</li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/editlearningareas.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Scheduling</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/modifyCurriculum.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Curriculum</span>
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
            <a class="nav-link" href="">
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
            <form class="form-sample" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                      <h2 class="fw-bold text-primary text-uppercase">Edit Information</h2>
                    </div>
                  </div>
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-12 grid-margin">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Personal Information</h4>
                              <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">Department <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <select class="form-select" name="F_department" required>
                                      <option selected><?php echo $getFacultyData['F_department'] ?></option>
                                      <option value="English">English Department</option>
                                      <option value="Filipino">Filipino Department</option>
                                      <option value="Mathematics">Mathematics Department</option>
                                      <option value="Science">Science Department</option>
                                      <option value="History">History Department</option>
                                      <option value="Personality Development">Personality Development Department</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <label class="col-sm-12 col-form-label">Profile Picture</label>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <div class="input-group col-xs-12">
                                        <input type="file" class="form-control file-upload-info" placeholder="Upload Image">
                                        <input type="hidden" name="F_number" value="<?php echo $_GET['F_number']; ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">Last Name <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_lname" value="<?php echo $getFacultyData['F_lname'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">First Name <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_fname" value="<?php echo $getFacultyData['F_fname'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <label class="col-sm-12 col-form-label">Middle Name</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_mname" value="<?php echo $getFacultyData['F_mname'] ?>">
                                  </div>
                                </div>
                                <div class="col-md-1">
                                  <label class="col-sm-12 col-form-label">Suffix</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_suffix" value="<?php echo $getFacultyData['F_suffix'] ?>">
                                  </div>

                                </div>
                              </div>

                              <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">Age <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="number" class="form-control" name="F_age" value="<?php echo $getFacultyData['F_age'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">Birthdate <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="date" class="form-control" name="F_birthday" value="<?php echo $getFacultyData['F_birthday'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">Gender <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <select class="form-select" name="F_gender" required>
                                      <option selected><?php echo $getFacultyData['F_gender'] ?></option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                      <option value="NA">Prefer not to say</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">Religion <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_religion" value="<?php echo $getFacultyData['F_religion'] ?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">Citizenship <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_citizenship" value="<?php echo $getFacultyData['F_citizenship'] ?>">
                                  </div>
                                </div>
                              </div>

                              <div class="row" style="padding-bottom: 15px;">
                                <h4 class="card-title" style="padding-top: 15px;">Address</h4>
                                <div class="col-md-6">
                                  <label label class="col-sm-12 col-form-label">Address <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_address" value="<?php echo $getFacultyData['F_address'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <label label class="col-sm-12 col-form-label">Barangay <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_barangay" value="<?php echo $getFacultyData['F_barangay'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <label label class="col-sm-12 col-form-label">City <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_city" value="<?php echo $getFacultyData['F_city'] ?>" required>
                                  </div>
                                </div>
                              </div>

                              <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-4">
                                  <label label class="col-sm-12 col-form-label">State <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_state" value="<?php echo $getFacultyData['F_state'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <label label class="col-sm-12 col-form-label">Postal Code <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_postal" value="<?php echo $getFacultyData['F_postal'] ?>" required>
                                  </div>
                                </div>
                              </div>

                              <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-6">
                                  <label label class="col-sm-12 col-form-label">Contact Number <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_contact" value="<?php echo $getFacultyData['F_contactNumber'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <label label class="col-sm-12 col-form-label">Email Address <span style="color: red;">*</span></label>
                                  <div class="col-sm-12">
                                    <input type="email" class="form-control" name="F_email" value="<?php echo $getFacultyData['F_email'] ?>" required>
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
                <button type="submit" class="btn btn-primary me-2" name="editFaculty">Save</button>
                <button class="btn btn-light">Back</button>
              </div>
            </form>
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

  <!-- JavaScript Libraries -->


  <!-- Template Javascript -->
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/admin/vendor.bundle.base.js"></script>
  <script src="../assets/js/admin/off-canvas.js"></script>
</body>

</html>