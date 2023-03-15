<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else {
  $facultyInformation = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$_SESSION['F_number']}'");
  $facultyData = $facultyInformation->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Faculty - Profile</title>
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
                    <h2 class="fw-bold text-primary text-uppercase">Profile Information</h2>
                  </div>
                </div>
                <form style="text-align: right; margin-top: 15px">
                  <a href="editProfile.php" class="btn btn-primary me-2">Edit</a>
                </form>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-lg-3 col-sm-12" style="padding-bottom: 20px;">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Profile Picture</h4>
                            <form class="form-sample">
                              <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-12 col-sm-6" style="text-align: center; margin-bottom: 20px; margin-top: 10px;">
                                  <?php
                                  $profile_path = "../assets/img/profile/" . $facultyData['F_profile_img'];
                                  if (empty($facultyData['F_profile_img']) || !file_exists($profile_path)) { ?>
                                    <img src="../assets/img/profile.png" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
                                  <?php } else { ?>
                                    <img src="../assets/img/profile/<?php echo $facultyData['F_profile_img'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
                                  <?php }
                                  ?>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-9 col-sm-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Personal Information</h4>
                            <form class="form-sample" action="confirmfaculty.php" method="POST">
                              <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-3">
                                  <label class="col-sm-12 col-form-label">Last Name</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_lname" value="<?php echo $facultyData['F_lname']; ?>" required readonly>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <label class="col-sm-12 col-form-label">First Name</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_fname" value="<?php echo $facultyData['F_fname']; ?>" required readonly>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <label class="col-sm-12 col-form-label">Middle Name</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_mname" value="<?php echo $facultyData['F_mname']; ?>" readonly>
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <label class="col-sm-12 col-form-label">Suffix</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" name="F_suffix" value="<?php echo $facultyData['F_suffix']; ?>" readonly>
                                  </div>

                                </div>

                                <div class="row" style="padding-bottom: 15px;">

                                  <div class="col-md-4 col-sm-12">
                                    <label class="col-sm-12 col-form-label">Age</label>
                                    <div class="col-sm-12">
                                      <input type="number" class="form-control" name="F_age" value="<?php echo $facultyData['F_age']; ?>" required readonly>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <label class="col-sm-12 col-form-label">Birthdate</label>
                                    <div class="col-sm-12">
                                      <input type="date" class="form-control" name="F_birthday" value="<?php echo $facultyData['F_birthday']; ?>" required readonly>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <label class="col-sm-12 col-form-label">Gender</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_gender" value="<?php echo $facultyData['F_gender']; ?>" required readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                  <div class="col-md-4">

                                    <label class="col-sm-12 col-form-label">Religion</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_religion" value="<?php echo $facultyData['F_religion']; ?>" readonly>
                                    </div>

                                  </div>
                                  <div class="col-md-4">
                                    <label class="col-sm-12 col-form-label">Citizenship</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_citizenship" value="<?php echo $facultyData['F_citizenship']; ?>" readonly />
                                    </div>

                                  </div>
                                </div>

                                <h4 class="card-title">Address</h4>
                                <div class="row" style="padding-bottom: 15px;">

                                  <div class="col-md-6">
                                    <label label class="col-sm-12 col-form-label">Address</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_address" value="<?php echo $facultyData['F_address']; ?>" required readonly>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <label label class="col-sm-12 col-form-label">Barangay</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_barangay" value="<?php echo $facultyData['F_barangay']; ?>" required readonly>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <label label class="col-sm-12 col-form-label">City</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_city" value="<?php echo $facultyData['F_city']; ?>" required readonly>
                                    </div>
                                  </div>

                                </div>

                                <div class="row" style="padding-bottom: 15px;">

                                  <div class="col-md-4">
                                    <label label class="col-sm-12 col-form-label">State</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_state" value="<?php echo $facultyData['F_state']; ?>" required readonly>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <label label class="col-sm-12 col-form-label">Postal Code</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_postal" value="<?php echo $facultyData['F_postal']; ?>" required readonly>
                                    </div>
                                  </div>

                                </div>

                                <div class="row" style="padding-bottom: 15px;">

                                  <div class="col-md-6">
                                    <label label class="col-sm-12 col-form-label">Contact Number</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="F_contact" value="<?php echo $facultyData['F_contactNumber']; ?>" required readonly>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <label label class="col-sm-12 col-form-label">Email Address</label>
                                    <div class="col-sm-12">
                                      <input type="email" class="form-control" name="F_email" value="<?php echo $facultyData['F_email']; ?>" required readonly>
                                    </div>
                                  </div>
                                </div>
                            </form>
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