<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['AD_number'])) {
  header('Location: ../auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Students</title>
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
              <span class="menu-title" style="color: #b9b9b9;">Admin Account</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/resetPassword.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Account Recovery</span>
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
            <a class="nav-link" href="../admin/student.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Student Information</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/editgrades.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Finalization of Grades</span>
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
              <span class="menu-title" style="color: #b9b9b9;">Daily Attendance</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/monthlyReports.php">
              <i class=""></i>
              <span class="menu-title" style="color: #b9b9b9;">Monthly Attendance</span>
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
                    <h2 class="fw-bold text-primary text-uppercase">Student Records</h2>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
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
                          echo '<a class="dropdown-item" href="student.php">' . $currentSchoolYear . '</a>';
                          $getstudentbyAcadYear = $mysqli->query("SELECT DISTINCT acadYear FROM classlist");
                          while ($byacadYear = $getstudentbyAcadYear->fetch_assoc()) {
                            if ($byacadYear['acadYear'] != $currentSchoolYear) {
                              echo '<a class="dropdown-item" href="student.php?SY=' . $byacadYear['acadYear'] . '">' . $byacadYear['acadYear'] . '</a>';
                            }
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="btn-group">
                      <div>
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                          <?php
                          if (isset($_GET['GradeLevel'])) {
                            if ($_GET['GradeLevel'] == 'KINDER') {
                              echo $_GET['GradeLevel'];
                            } else {
                              echo "Grade " . $_GET['GradeLevel'];
                            }
                          } else {
                            echo "Grade ";
                          }
                          ?>
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <?php
                          $sectionList = "SELECT DISTINCT(S_yearLevel) FROM sections";
                          $runsectionList = $mysqli->query($sectionList);

                          while ($sectionData = $runsectionList->fetch_assoc()) {
                            if (isset($_GET['SY'])) { ?>
                              <a class="dropdown-item" href="student.php?SY=<?php echo $_GET['SY'] ?>&GradeLevel=<?php echo $sectionData['S_yearLevel'] ?>">
                                <?php
                                if ($sectionData['S_yearLevel'] == 'KINDER') {
                                  echo $sectionData['S_yearLevel'];
                                } else {
                                  echo "Grade " . $sectionData['S_yearLevel'];
                                }
                                ?>
                              </a>
                            <?php } else { ?>
                              <a class="dropdown-item" href="student.php?GradeLevel=<?php echo $sectionData['S_yearLevel'] ?>">
                                <?php
                                if ($sectionData['S_yearLevel'] == 'KINDER') {
                                  echo $sectionData['S_yearLevel'];
                                } else {
                                  echo "Grade " . $sectionData['S_yearLevel'];
                                }
                                ?>
                              </a>
                            <?php }
                            ?>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <?php
                    if (isset($_GET['GradeLevel'])) { ?>
                      <div class="btn-group">
                        <div>
                          <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                            <?php
                            if (!isset($_GET['section'])) {
                              echo 'Section';
                            } else {
                              echo $_GET['section'];
                            }
                            ?>
                            <i class="fa fa-caret-down"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php
                            $sectionData = $mysqli->query("SELECT DISTINCT(S_name) FROM sections WHERE S_yearLevel = '{$_GET['GradeLevel']}'");
                            while ($section = $sectionData->fetch_assoc()) {
                              if (isset($_GET['SY'])) { ?>
                                <a class="dropdown-item" href="student.php?SY=<?php echo $_GET['SY'] ?>&GradeLevel=<?php echo $_GET['GradeLevel'] ?>&section=<?php echo $section['S_name'] ?>">
                                  <?php echo $section['S_name'] ?>
                                </a>
                              <?php } else { ?>
                                <a class="dropdown-item" href="student.php?GradeLevel=<?php echo $_GET['GradeLevel'] ?>&section=<?php echo $section['S_name'] ?>">
                                  <?php echo $section['S_name'] ?>
                                </a>
                            <?php }
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                    <?php }
                    ?>
                    <?php
                    if (isset($_GET['GradeLevel']) && isset($_GET['section'])) {
                      echo '<div class="btn-group" style="float: right;"><a href="../reports/getClasslist.php?GradeLevel=' . $_GET['GradeLevel'] . '&section=' . $_GET['section'] . '" style="background-color: #e4e3e3; margin-right: 0px;" class="btn btn-secondary">Download <i class="fa fa-download" style="font-size: 12px; align-self:center;"></i></a></div>';
                    } else {
                      echo '<div class="btn-group" style="float: right;"><a href="../reports/getClasslist.php?allstudent=true" style="background-color: #e4e3e3; margin-right: 0px;" class="btn btn-secondary">Download <i class="fa fa-download" style="font-size: 12px; align-self:center;"></i></a></div>';
                    }
                    ?>
                    <div class="row" style="margin-top: 15px;">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <style>
                                      .tablestyle {
                                        border: 1px solid #ffffff;
                                        text-align: center;
                                        vertical-align: middle;
                                        height: 30px;
                                        color: #000000;
                                      }
                                    </style>
                                    <tr>
                                      <th class="tablestyle">No.</th>
                                      <th class="tablestyle">Student Number</th>
                                      <th class="tablestyle">Grades and Section</th>
                                      <th class="tablestyle">Student Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    if (isset($_GET['SY']) && !isset($_GET['GradeLevel'])  && !isset($_GET['section'])) {
                                      $ListofStudents = $mysqli->query("SELECT * FROM studentrecord RIGHT JOIN classlist ON studentrecord.SR_number = classlist.SR_number WHERE classlist.acadYear = '{$_GET['SY']}' ORDER BY SR_lname");
                                    } else if (isset($_GET['SY']) && isset($_GET['GradeLevel'])  && !isset($_GET['section'])) {
                                      $ListofStudents = $mysqli->query("SELECT * FROM studentrecord RIGHT JOIN classlist ON studentrecord.SR_number = classlist.SR_number WHERE classlist.SR_grade = '{$_GET['GradeLevel']}' AND classlist.acadYear = '{$_GET['SY']}' ORDER BY SR_lname");
                                    } else if (isset($_GET['SY']) && isset($_GET['GradeLevel'])  && isset($_GET['section'])) {
                                      $ListofStudents = $mysqli->query("SELECT * FROM studentrecord RIGHT JOIN classlist ON studentrecord.SR_number = classlist.SR_number WHERE classlist.SR_grade = '{$_GET['GradeLevel']}' AND classlist.SR_section = '{$_GET['section']}' AND classlist.acadYear = '{$_GET['SY']}' ORDER BY SR_lname");
                                    }

                                    if (!isset($_GET['SY']) && !isset($_GET['GradeLevel'])  && !isset($_GET['section'])) {
                                      $ListofStudents = $mysqli->query("SELECT * FROM studentrecord JOIN classlist ON studentrecord.SR_number = classlist.SR_number WHERE classlist.acadYear = '{$currentSchoolYear}' ORDER BY SR_lname");
                                    } elseif (!isset($_GET['SY']) && isset($_GET['GradeLevel'])) {
                                      $ListofStudents = $mysqli->query("SELECT * FROM studentrecord JOIN classlist ON studentrecord.SR_number = classlist.SR_number WHERE classlist.SR_grade = '{$_GET['GradeLevel']}' AND classlist.acadYear = '{$currentSchoolYear}' ORDER BY SR_lname");
                                    } else if (!isset($_GET['SY']) && isset($_GET['GradeLevel'])  && isset($_GET['section'])) {
                                      $ListofStudents = $mysqli->query("SELECT * FROM studentrecord JOIN classlist ON studentrecord.SR_number = classlist.SR_number WHERE classlist.SR_grade = '{$_GET['GradeLevel']}' AND classlist.SR_section = '{$_GET['section']}' AND classlist.acadYear = '{$currentSchoolYear}' ORDER BY SR_lname");
                                    } else {
                                      $ListofStudents = $mysqli->query("SELECT * FROM studentrecord RIGHT JOIN classlist ON studentrecord.SR_number = classlist.SR_number WHERE classlist.acadYear = '{$currentSchoolYear}' ORDER BY SR_lname");
                                    }
                                    $rowCount = 1;

                                    if (mysqli_num_rows($ListofStudents) > 0) {
                                      while ($data = $ListofStudents->fetch_assoc()) { ?>
                                        <tr>
                                          <td class="tablestyle"><?php echo $rowCount ?></td>
                                          <td class="tablestyle"><?php echo $data['SR_number'] ?></td>
                                          <td class="tablestyle">
                                            <?php
                                            if ($data['SR_grade'] == 'KINDER') {
                                              echo $data['SR_grade'] . " - " . $data['SR_section'];
                                            } else {
                                              echo "Grade " . $data['SR_grade'] . " - " . $data['SR_section'];
                                            }
                                            ?>
                                          </td>
                                          <td class="tablestyle">
                                            <?php
                                            if (isset($_GET['SY'])) {
                                              echo '<a href="viewStudent.php?SY=' . $_GET['SY'] . '&SR_Number=' . $data['SR_number'] . '">';
                                            } else {
                                              echo '<a href="viewStudent.php?SR_Number=' . $data['SR_number'] . '">';
                                            }

                                            $getstudentname = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$data['SR_number']}'");
                                            $studentname = $getstudentname->fetch_assoc();

                                            if (!empty($studentname['SR_mname']) || $studentname['SR_mname'] != "" && empty($studentname['SR_suffix']) || $studentname['SR_suffix'] = "") {
                                              echo $studentname['SR_lname'] .  ", " . $studentname['SR_fname'] . " " . substr($studentname['SR_mname'], 0, 1) . ".";
                                            } else if (empty($studentname['SR_mname']) || $studentname['SR_mname'] = "" && !empty($studentname['SR_suffix']) || $studentname['SR_suffix'] != "") {
                                              echo $studentname['SR_lname'] .  ", " . $studentname['SR_fname'] . " " . $studentname['SR_suffix'];
                                            } else if (empty($studentname['SR_mname']) || $studentname['SR_mname'] = "" && empty($studentname['SR_suffix']) || $studentname['SR_suffix'] = "") {
                                              echo $studentname['SR_lname'] .  ", " . $studentname['SR_fname'];
                                            }
                                            ?>
                                            </a>
                                          </td>
                                        </tr>
                                      <?php $rowCount++;
                                      }
                                    } else { ?>
                                      <tr>
                                        <td colspan="10">No Data.</td>
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
</body>

</html>