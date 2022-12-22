<?php require_once("../assets/php/server.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Edit Grades</title>
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
    <img class="m-3" src="../assets/img/logo.png" style="height: 50px; width:50px;" alt="Icon">
    <div class="d-flex align-items-center justify-content-center text-center">
      <a href="../index.php" class="navbar-brand ms-4 ms-lg-0 text-center">
        <h1 class="cdsp">Colegio De San Pedro</h1>
        <h1 class="cdsp1" alt="Icon">Student Information and Monitoring System</h1>
      </a>
    </div>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </nav>
  <!-- Navbar End -->

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category" style="text-align:center; font-size: 20px;">ADMIN</li>
          <!-- item 1 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" href="../admin/dashboard.php">
              <i class="menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!-- item 2 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" href="../admin/addStudent.php">
              <i class="menu-icon"></i>
              <span class="menu-title">Add Student</span>
            </a>
          </li>
          <!-- item 3 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#records" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon"></i>
              <span class="menu-title">Records</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="records">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="../admin/editgrades.php">Grades</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/student.php">Student Information</a></li>
              </ul>
            </div>
          </li>
          <!-- item 4 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reports">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="../admin/dailyReports.php">Daily Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/monthlyReports.php">Monthly Reports</a></li>
              </ul>
            </div>
          </li>
          <!-- item 5 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" data-bs-toggle="collapse" href="#faculty" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon"></i>
              <span class="menu-title">Faculty</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="faculty">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="../admin/addFaculty.php">Add Faculty</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/faculty.php">Faculty</a></li>
                <li class="nav-item"><a class="nav-link" href="../admin/editlearningareas.php">Assign Faculty</a></li>
              </ul>
            </div>
          </li>
          <!-- item 6 -->
          <li class="nav-item" style="border-bottom: 1px solid rgba(255, 255, 255, 0.13); margin: 0 30px;">
            <a class="nav-link" href="index.html">
              <i class="menu-icon"></i>
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
                    <h2 class="fw-bold text-primary text-uppercase">Edit Records</h2>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="btn-group">
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <?php if (isset($_GET['orderByGradeSection'])) {
                            echo "Grade Level: " . $_GET['GradeLevel'] . " - " . $_GET['orderByGradeSection'];
                          } else {
                            echo "Grade and Section";
                          }
                          ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <?php
                          $sectionList = "SELECT S_name, S_yearLevel FROM sections";
                          $runsectionList = $mysqli->query($sectionList);

                          while ($sectionData = $runsectionList->fetch_assoc()) { ?>
                            <a class="dropdown-item" href="editgrades.php?GradeLevel=<?php echo $sectionData['S_yearLevel'] ?>&orderByGradeSection=<?php echo $sectionData['S_name'] ?>">
                              <?php
                              if (strpos($sectionData['S_yearLevel'], "KINDER")) {
                                echo $sectionData['S_yearLevel'] . " - " . $sectionData['S_name'];
                              } else {
                                echo "Grade - " . $sectionData['S_yearLevel'] . " - " . $sectionData['S_name'];
                              }
                              ?>
                            </a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <?php if (isset($_GET['orderByGradeSection'])) { ?>
                      <div class="btn-group">
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php
                            $current_url = $_SERVER["REQUEST_URI"];
                            if (isset($_GET['orderByLearningArea'])) {
                              echo $_GET['orderByLearningArea'];

                              $find = "&orderByLearningArea=" . $_GET['orderByLearningArea'];
                              if (strpos($current_url, $find)) {
                                $current_url = str_replace($find, "", $current_url);
                              }
                            } else {
                              echo "Learning Areas";

                              $find = "orderByLearningArea=";
                              if (strpos($current_url, $find)) {
                                $current_url = str_replace($find, "", $current_url);
                              }
                            }
                            ?>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <a class="dropdown-item" href="<?php echo $current_url . "&orderByLearningArea=Math" ?>">Mathematics</a>
                            <a class="dropdown-item" href="<?php echo $current_url . "&orderByLearningArea=English" ?>">English</a>
                            <a class="dropdown-item" href="<?php echo $current_url . "&orderByLearningArea=Filipino" ?>">Filipino</a>
                            <a class="dropdown-item" href="<?php echo $current_url . "&orderByLearningArea=Science" ?>">Science</a>
                            <a class="dropdown-item" href="<?php echo $current_url . "&orderByLearningArea=History" ?>">History</a>
                            <a class="dropdown-item" href="<?php echo $current_url . "&orderByLearningArea=Character_Development" ?>">Character Development</a>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card bg-primary card-rounded">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <style>
                                      .grade_table {
                                        border: 1px solid #ffffff;
                                        text-align: center;
                                        vertical-align: middle;
                                        height: 30px;
                                        color: #000000;
                                      }

                                      input[type='number'] {
                                        width: 50px;
                                      }

                                      /* Chrome, Safari, Edge, Opera */
                                      input::-webkit-outer-spin-button,
                                      input::-webkit-inner-spin-button {
                                        -webkit-appearance: none;
                                        margin: 0;
                                      }

                                      /* Firefox */
                                      input[type=number] {
                                        -moz-appearance: textfield;
                                      }
                                    </style>
                                    <tr>
                                      <th rowspan="2" class="grade_table">No.</th>
                                      <th rowspan="2" class="grade_table">Student Name</th>
                                      <th rowspan="2" class="grade_table">Grade Level - Section</th>
                                      <th colspan="4" class="grade_table">Quarter</th>
                                      <th rowspan="2" class="grade_table">Final Grade</th>
                                      <th rowspan="2" class="grade_table">Action</th>
                                    </tr>
                                    <tr>
                                      <th class="grade_table">1</th>
                                      <th class="grade_table">2</th>
                                      <th class="grade_table">3</th>
                                      <th class="grade_table">4</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if (!empty(isset($_GET['orderByGradeSection'])) && !empty(isset($_GET['orderByLearningArea']))) {
                                      $byGradeLevel = $_GET['orderByGradeSection'];
                                      $bySubject = $_GET['orderByLearningArea'];
                                      $getData = "SELECT studentrecord.SR_number, studentrecord.SR_fname, studentrecord.SR_lname,
                                                         grades.SR_gradeLevel, grades.SR_section, grades.G_learningArea, 
                                                         grades.G_id, grades.G_gradesQ1, grades.G_gradesQ2, grades.G_gradesQ3, grades.G_gradesQ4
                                                  FROM studentrecord 
                                                  INNER JOIN grades
                                                  ON studentrecord.SR_number = grades.SR_number
                                                  WHERE studentrecord.SR_section = '$byGradeLevel'
                                                  AND G_learningArea = '$bySubject'";
                                      $rungetData = $mysqli->query($getData);
                                      $rowNum = 1;
                                      while ($gradeData =  $rungetData->fetch_assoc()) { ?>
                                        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                                          <tr>
                                            <td class="grade_table"><?php echo $rowNum; ?><input type="hidden" value="<?php echo $gradeData['G_id']; ?>" name="G_id"></td>
                                            <td class="grade_table"><?php echo $gradeData['SR_lname'] . ", " . $gradeData['SR_fname'] ?><input type="hidden" name="SR_number" value="<?php echo $gradeData['SR_number'] ?>"></td>
                                            <td class="grade_table">
                                              <?php echo $gradeData['SR_gradeLevel'] . " - " . $gradeData['SR_section'] ?>
                                              <input type="hidden" name="SR_section" value="<?php echo $gradeData['SR_section'] ?>">
                                              <input type="hidden" name="G_learningArea" value="<?php echo $gradeData['G_learningArea'] ?>">
                                            </td>
                                            <?php
                                            if ($gradeData['G_gradesQ1']) { ?>
                                              <td class="grade_table"><input type="number" value="<?php echo $gradeData['G_gradesQ1']; ?>" name="G_gradesQ1" style="text-align: center;"></td>
                                            <?php
                                            } else { ?>
                                              <td class="grade_table"><input type="number" placeholder="##" style="text-align: center;" disabled></td>
                                            <?php } ?>

                                            <?php
                                            if ($gradeData['G_gradesQ2']) { ?>
                                              <td class="grade_table"><input type="number" value="<?php echo $gradeData['G_gradesQ2']; ?>" name="G_gradesQ2" style="text-align: center;"></td>
                                            <?php
                                            } else { ?>
                                              <td class="grade_table"><input type="number" placeholder="##" style="text-align: center;" disabled></td>
                                            <?php } ?>

                                            <?php
                                            if ($gradeData['G_gradesQ3']) { ?>
                                              <td class="grade_table"><input type="number" value="<?php echo $gradeData['G_gradesQ3']; ?>" name="G_gradesQ3" style="text-align: center;"></td>
                                            <?php
                                            } else { ?>
                                              <td class="grade_table"><input type="number" placeholder="##" style="text-align: center;" disabled></td>
                                            <?php } ?>

                                            <?php
                                            if ($gradeData['G_gradesQ4']) { ?>
                                              <td class="grade_table"><input type="number" value="<?php echo $gradeData['G_gradesQ4']; ?>" name="G_gradesQ4" style="text-align: center;"></td>
                                            <?php
                                            } else { ?>
                                              <td class="grade_table"><input type="number" placeholder="##" style="text-align: center;" disabled></td>
                                            <?php } ?>

                                            <td class="grade_table">
                                              <input type="number" placeholder="##" title="This is only an estimation of the final grade and will only reflect on the last day of the semester" style="text-align: center;" disabled>
                                            </td>
                                            <td class="grade_table">
                                              <input type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>" name="current_url">
                                              <input type="submit" class="btn btn-primary" name="UpdateGrade">
                                            </td>
                                          </tr>
                                        </form>
                                      <?php $rowNum++;
                                      }
                                    } else { ?>
                                      <tr>
                                        <td colspan="10">No Data. Please Select from the options above.</td>
                                      </tr>
                                    <?php } ?>
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
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-body footer mt-5 pt-5 px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-3 col-md-6">
          <h3 class="text-light mb-4">Address</h3>
          <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Phase 1A, Pacita Complex 1, San Pedro City, Laguna 4023</p>
          <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+63 919 065 6576</p>
          <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>di ko alam email</p>
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
  <script src="../assets/js/admin/js/off-canvas.js"></script>

</body>

</html>