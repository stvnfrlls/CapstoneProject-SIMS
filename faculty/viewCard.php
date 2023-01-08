<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: advisoryPage.php');
} elseif ($_GET['viewStudent']) {
  $getStudentRecord = "SELECT * FROM studentrecord WHERE SR_number = '{$_GET['viewStudent']}'";
  $rungetStudentRecord = $mysqli->query($getStudentRecord);
  $StudentData = $rungetStudentRecord->fetch_assoc();

  $getSectionInfo = "SELECT * FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'";
  $rungetSectionInfo = $mysqli->query($getSectionInfo);
  $SectionData = $rungetSectionInfo->fetch_assoc();
  $getSectionClassList = "SELECT SR_number FROM studentrecord WHERE SR_section = '{$SectionData['S_name']}'";
  $rungetSectionClassList = $mysqli->query($getSectionClassList);

  $getFacultyName = "SELECT * FROM faculty WHERE F_number = '{$_SESSION['F_number']}'";
  $rungetFacultyName = $mysqli->query($getFacultyName);
  $FacultyData = $rungetFacultyName->fetch_assoc();

  $getStudentGrades = "SELECT * FROM grades WHERE SR_number = '{$_GET['viewStudent']}'";
  $rungetStudentGrades = $mysqli->query($getStudentGrades);

  $getBehaviorData = "SELECT * FROM behavior WHERE SR_number = '{$_GET['viewStudent']}'";
  $rungetBehaviorData = $mysqli->query($getBehaviorData);
  $BehaviorData = $rungetBehaviorData->fetch_assoc();
} else {
  header('Location: advisoryPage.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Faculty - Report Card</title>
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
          <li class="nav-item" style="text-align:center; font-size: 20px; color: #b9b9b9; margin-top:20px;">FACULTY</li>
          <!-- line 1 -->
          <li class="nav-item nav-category">Profile</li>
          <li class="nav-item">
            <a class="nav-link" href="">
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
            <a class="nav-link" href="../faculty/viewReminders.php">
              <i class=""></i>
              <span class="menu-title">View Reminders</span>
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
                    <h2 class="fw-bold text-primary text-uppercase">STUDENT REPORT CARD</h2>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <form class="form-sample" action="confirmfaculty.php" method="POST">
                              <div class="row" style="--bs-gutter-x: 0px; margin-bottom:20px;">
                                <table id="head" class="table">
                                  <tr>
                                    <td class="hatdog" style="text-align: left;"><?php echo "NAME: " . $StudentData['SR_lname'] . ", " . $StudentData['SR_fname'] . " " . substr($StudentData['SR_mname'], 0, 1); ?></td>
                                    <td class="hatdog" style="text-align: left;"><?php echo "STUDENT NUMBER: " . $StudentData['SR_number'] ?></td>
                                  </tr>
                                  <tr>
                                    <td class="hatdog" style="text-align: left;">Grade and Section: <?php echo $StudentData['SR_grade'] . " - " . $StudentData['SR_section'] ?></td>
                                    <td class="hatdog" style="text-align: left;">Adviser: <?php echo $FacultyData['F_lname'] . ", " . $FacultyData['F_fname'] . " " . substr($FacultyData['F_mname'], 0, 1); ?></td>
                                  </tr>
                                </table>
                                <div class="col m-3">
                                  <?php
                                  $studentLink = array();
                                  while ($ClassListData = $rungetSectionClassList->fetch_assoc()) {
                                    $studentLink[] = $ClassListData['SR_number'];
                                  }
                                  $value = $_GET['viewStudent'];
                                  $index = array_search($value, $studentLink);
                                  if ($index !== false) {
                                    current($studentLink);
                                    while (key($studentLink) !== $index) {
                                      next($studentLink);
                                    }
                                  }
                                  ?>
                                  <a href="viewCard.php?viewStudent=<?php echo next($studentLink) ?>"> Next </a>
                                </div>
                              </div>
                              <div class="row">
                                <div class="table-responsive">
                                  <table class="table text-center">
                                    <thead>
                                      <tr>
                                        <th rowspan="2" class="hatdog">Learning Areas</th>
                                        <th colspan="4" class="hatdog">Periodic Rating</th>
                                        <th rowspan="2" class="hatdog">Final Rating</th>
                                        <th rowspan="2" class="hatdog">Remarks</th>
                                      </tr>
                                      <tr>
                                        <td class="hatdog" style="border-color: #FFFFFF;">1</td>
                                        <td class="hatdog" style="border-color: #FFFFFF;">2</td>
                                        <td class="hatdog" style="border-color: #FFFFFF;">3</td>
                                        <td class="hatdog" style="border-color: #FFFFFF;">4</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      if ($rungetStudentGrades->num_rows > 0) {
                                        while ($StudentGrades = $rungetStudentGrades->fetch_assoc()) { ?>
                                          <tr>
                                            <td class="hatdog"><?php echo $StudentGrades['G_learningArea']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_gradesQ1']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_gradesQ2']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_gradesQ3']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_gradesQ4']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_finalgrade']; ?></td>
                                            <td class="hatdog">Passed</td>
                                          </tr>
                                        <?php }
                                      } else { ?>
                                        <tr>
                                          <td class="hatdog">NO SUBJECTS</td>
                                          <td class="hatdog" colspan="5">NO GRADES RECORDED</td>
                                          <td class="hatdog"></td>
                                        </tr>
                                      <?php }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="row" style="--bs-gutter-x: 14px; --bs-gutter-y: 10px;">
                                  <table id="ave" class="table text-center">
                                    <tr>
                                      <td class="hatdog"> General Average</td>
                                      <td class="hatdog">90</td>
                                    </tr>
                                  </table>
                                </div>
                                <div class="container">
                                  <div id="remarkshead" class="row fw-bold">
                                    <div class="col">Descriptors</div>
                                    <div class="col">Grading Scale</div>
                                    <div class="col">Remarks</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">Outstanding</div>
                                    <div class="col">90-100</div>
                                    <div class="col">Passed</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">Very Satisfactory</div>
                                    <div class="col">85-89</div>
                                    <div class="col">Passed</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">Satisfactory</div>
                                    <div class="col">80-84</div>
                                    <div class="col">Passed</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">Fairly Satisfactory</div>
                                    <div class="col">75-79</div>
                                    <div class="col">Passed</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">Did Not Meet Expectations</div>
                                    <div class="col">Below 75</div>
                                    <div class="col">Failed</div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <form class="form-sample" action="confirmfaculty.php" method="POST">
                              <h3 style="text-align: center;">CHARACTER BUILDING</h3>
                              <div class="row">
                                <div class="table-responsive">
                                  <table class="table text-center">
                                    <thead>
                                      <tr>
                                        <th rowspan="2" class="hatdog">Core Values</th>
                                        <th rowspan="2" class="hatdog">Behavior Statements</th>
                                        <th colspan="4" class="hatdog">Periodic Rating</th>
                                      </tr>
                                      <tr>
                                        <td class="hatdog" style="border-color: #FFFFFF;">1</td>
                                        <td class="hatdog" style="border-color: #FFFFFF;">2</td>
                                        <td class="hatdog" style="border-color: #FFFFFF;">3</td>
                                        <td class="hatdog" style="border-color: #FFFFFF;">4</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      if ($rungetBehaviorData->num_rows > 0) { ?>
                                        <tr>
                                          <td rowspan="2" class="hatdog">Maka-Diyos</td>
                                          <td rowspan="1" class="hatdog">Expresses one spiritual beliefs <br> while respecting the spiritual beliefs of others.</td>
                                          <?php
                                          $CV_value1_1_Count = 1;
                                          while ($CV_value1_1_Count != 5) {
                                            if ($BehaviorData['B_PeriodicRating'] == $CV_value1_1_Count) { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" value="<?php echo $BehaviorData['CV_value1_1'] ?>" size="2">
                                              </td>
                                            <?php } else { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" size="2" readonly>
                                              </td>
                                          <?php }
                                            $CV_value1_1_Count++;
                                          } ?>
                                        </tr>
                                        <tr>
                                          <td rowspan="1" class="hatdog">Show adherence to ethical principle by upholding truth.</td>
                                          <?php
                                          $CV_value1_2_Count = 1;
                                          while ($CV_value1_2_Count != 5) {
                                            if ($BehaviorData['B_PeriodicRating'] == $CV_value1_2_Count) { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" value="<?php echo $BehaviorData['CV_value1_2'] ?>" size="2">
                                              </td>
                                            <?php } else { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" size="2" readonly>
                                              </td>
                                          <?php }
                                            $CV_value1_2_Count++;
                                          } ?>
                                        </tr>

                                        <tr>
                                          <td rowspan="2" class="hatdog">Makatao</td>
                                          <td rowspan="1" class="hatdog">Is sensitive to individual, social, and cultural differences.</td>
                                          <?php
                                          $CV_value2_1_Count = 1;
                                          while ($CV_value2_1_Count != 5) {
                                            if ($BehaviorData['B_PeriodicRating'] == $CV_value2_1_Count) { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" value="<?php echo $BehaviorData['CV_value2_1'] ?>" size="2">
                                              </td>
                                            <?php } else { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" size="2" readonly>
                                              </td>
                                          <?php }
                                            $CV_value2_1_Count++;
                                          } ?>
                                        </tr>
                                        <tr>
                                          <td rowspan="1" class="hatdog">Demonstrates contributions toward solidarity.</td>
                                          <?php
                                          $CV_value2_2_Count = 1;
                                          while ($CV_value2_2_Count != 5) {
                                            if ($BehaviorData['B_PeriodicRating'] == $CV_value2_2_Count) { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" value="<?php echo $BehaviorData['CV_value2_2'] ?>" size="2">
                                              </td>
                                            <?php } else { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" size="2" readonly>
                                              </td>
                                          <?php }
                                            $CV_value2_2_Count++;
                                          } ?>
                                        </tr>

                                        <tr>
                                          <td rowspan="1" class="hatdog">Makalikasan</td>
                                          <td rowspan="1" class="hatdog">Cares for the environment and utilizes resources wisely, judiously and economically.</td>
                                          <?php
                                          $CV_value3_Count = 1;
                                          while ($CV_value3_Count != 5) {
                                            if ($BehaviorData['B_PeriodicRating'] == $CV_value3_Count) { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" value="<?php echo $BehaviorData['CV_value3'] ?>" size="2">
                                              </td>
                                            <?php } else { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" size="2" readonly>
                                              </td>
                                          <?php }
                                            $CV_value3_Count++;
                                          } ?>
                                        </tr>

                                        <tr>
                                          <td rowspan="2" class="hatdog">Makabansa</td>
                                          <td rowspan="1" class="hatdog">Demonstrates pride in being a Filipino, exercises the rights and responsibilities of a Filipino citizen.</td>
                                          <?php
                                          $CV_value4_1_Count = 1;
                                          while ($CV_value4_1_Count != 5) {
                                            if ($BehaviorData['B_PeriodicRating'] == $CV_value4_1_Count) { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" value="<?php echo $BehaviorData['CV_value4_1'] ?>" size="2">
                                              </td>
                                            <?php } else { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" size="2" readonly>
                                              </td>
                                          <?php }
                                            $CV_value4_1_Count++;
                                          } ?>
                                        </tr>
                                        <tr>
                                          <td rowspan="1" class="hatdog">Demonstrates appropriate behavior in carrying out activities in the school, community and country.</td>
                                          <?php
                                          $CV_value4_2_Count = 1;
                                          while ($CV_value4_2_Count != 5) {
                                            if ($BehaviorData['B_PeriodicRating'] == $CV_value4_2_Count) { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" value="<?php echo $BehaviorData['CV_value4_2'] ?>" size="2">
                                              </td>
                                            <?php } else { ?>
                                              <td rowspan="1" class="hatdog">
                                                <input type="text" class="hatdog" size="2" readonly>
                                              </td>
                                          <?php }
                                            $CV_value4_2_Count++;
                                          } ?>
                                        </tr>
                                      <?php } else { ?>
                                        <tr>
                                          <td rowspan="2" class="hatdog">Maka-Diyos</td>
                                          <td rowspan="1" class="hatdog">Expresses one spiritual beliefs while respecting the spiritual beliefs of others.</td>
                                          <td colspan="4" rowspan="7" class="hatdog">NO DATA</td>
                                        </tr>
                                        <tr>
                                          <td rowspan="1" class="hatdog">Show adherence to ethical principle by upholding truth.</td>
                                        </tr>

                                        <tr>
                                          <td rowspan="2" class="hatdog">Makatao</td>
                                          <td rowspan="1" class="hatdog">Is sensitive to individual, social, and cultural differences.</td>
                                        </tr>
                                        <tr>
                                          <td rowspan="1" class="hatdog">Demonstrates contributions toward solidarity.</td>
                                        </tr>

                                        <tr>
                                          <td rowspan="1" class="hatdog">Makalikasan</td>
                                          <td rowspan="1" class="hatdog">Cares for the environment and utilizes resources wisely, judiously and economically.</td>
                                        </tr>

                                        <tr>
                                          <td rowspan="2" class="hatdog">Makabansa</td>
                                          <td rowspan="1" class="hatdog">Demonstrates pride in being a Filipino, exercises the rights and responsibilities of a Filipino citizen.</td>
                                        </tr>
                                        <tr>
                                          <td rowspan="1" class="hatdog">Demonstrates appropriate behavior in carrying out activities in the school, community and country.</td>
                                        </tr>
                                      <?php }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>

                                <div class="container">
                                  <div id="remarkshead" class="row fw-bold" style="margin-top: 20px;">
                                    <div class="col">Marking</div>
                                    <div class="col">Non-Numerical Rating</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">AO</div>
                                    <div class="col">Always Observed</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">SO</div>
                                    <div class="col">Sometimes Observed</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">RO</div>
                                    <div class="col">Rarely Observed</div>
                                  </div>
                                  <div id="remarks" class="row fw-light">
                                    <div class="col">NO</div>
                                    <div class="col">Not Observed</div>
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
            <form style="text-align: center;">
              <button type="submit" class="btn btn-primary me-2">Save</button>
              <button class="btn btn-light">Cancel</button>
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
  <script src="../assets/js/admin/off-canvas.js"></script>
  <script src="../assets/js/admin/file-upload.js"></script>

</body>

</html>