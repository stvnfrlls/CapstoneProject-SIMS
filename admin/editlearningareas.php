<?php
require_once("../assets/php/server.php");

if (empty($_SESSION['AD_number'])) {
  header('Location: ../auth/login.php');
} else {
  $gradeList = "SELECT DISTINCT S_yearLevel FROM sections WHERE acadYear = '{$currentSchoolYear}'";
  $rungradeList = $mysqli->query($gradeList);

  if (isset($_GET['GradeLevel'])) {
    $sectionList = "SELECT DISTINCT(S_name) FROM sections WHERE S_yearLevel = '{$_GET['GradeLevel']}' AND acadYear = '{$currentSchoolYear}'";
    $runsectionList = $mysqli->query($sectionList);
  }

  if (isset($_GET['GradeLevel']) && isset($_GET['SectionName'])) {
    $subjects     = array();
    array_unshift($subjects, null);
    $schedule     = array();
    array_unshift($schedule, null);
    $FacultyName  = array();
    array_unshift($FacultyName, null);
    $AllFacultyName  = array();
    array_unshift($AllFacultyName, null);

    if ($_GET['GradeLevel'] == "KINDER") {
      $getSubject = "SELECT subjectName FROM subjectperyear
                  WHERE
                  subjectperyear.minYearLevel = '0' 
                  AND
                  subjectperyear.maxYearLevel >= '0'";
    } else {
      $getSubject = "SELECT subjectName FROM subjectperyear
                  WHERE 
                  subjectperyear.minYearLevel <= '{$_GET['GradeLevel']}' 
                  AND
                  subjectperyear.maxYearLevel >= '{$_GET['GradeLevel']}'";
    }
    $rungetSubject = $mysqli->query($getSubject);
    while ($dataSubject = $rungetSubject->fetch_assoc()) {
      $subjects[] = $dataSubject;
    }

    $getSchedule = "SELECT F_number, S_subject, WS_start_time, WS_end_time FROM workschedule
                  WHERE SR_grade = '{$_GET['GradeLevel']}' 
                  AND SR_section = '{$_GET['SectionName']}'
                  AND acadYear = '{$currentSchoolYear}'";
    $rungetSchedule = $mysqli->query($getSchedule);
    while ($dataSchedule = $rungetSchedule->fetch_assoc()) {
      $schedule[] = $dataSchedule;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Work Schedule Assignment</title>
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
                    <h2 class="fw-bold text-primary text-uppercase">Work Schedule Assignment</h2>
                  </div>
                </div>

                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="btn-group">
                      <div>
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                          <?php
                          if (isset($_GET['GradeLevel'])) {
                            if ($_GET['GradeLevel'] == "KINDER") {
                              echo  $_GET['GradeLevel'];
                            } else {
                              echo  "Grade " . $_GET['GradeLevel'];
                            }
                          } else {
                            echo "Grade ";
                          }
                          ?>
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <?php
                          while ($gradeData = $rungradeList->fetch_assoc()) { ?>
                            <a class="dropdown-item" href="editlearningareas.php?GradeLevel=<?php echo $gradeData['S_yearLevel'] ?>">
                              <?php
                              if ($gradeData['S_yearLevel'] == 'KINDER') {
                                echo $gradeData['S_yearLevel'];
                              } else {
                                echo "Grade " . $gradeData['S_yearLevel'];
                              }
                              ?>
                            </a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="btn-group">
                      <?php
                      if (isset($_GET['GradeLevel'])) { ?>
                        <div>
                          <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                            <?php if (isset($_GET['SectionName'])) {
                              echo $_GET['SectionName'];
                            } else {
                              echo "Section";
                            }
                            ?>
                            <i class="fa fa-caret-down"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php
                            while ($sectionData = $runsectionList->fetch_assoc()) { ?>
                              <a class="dropdown-item" href="editlearningareas.php?GradeLevel=<?php echo $_GET['GradeLevel'] . "&SectionName=" . $sectionData['S_name']; ?>">
                                <?php
                                echo $sectionData['S_name'];
                                ?>
                              </a>
                            <?php } ?>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                      <div class="alert alert-danger text-center">
                        <?php
                        foreach ($errors as $showerror) {
                          echo $showerror;
                        }
                        ?>
                      </div>
                    <?php
                    }
                    ?>
                    <div class="row" style="margin-top: 15px;">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Subject Name</th>
                                      <th>Assigned Teacher</th>
                                      <th>Start Time</th>
                                      <th>End Time</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $rowCount = 1;
                                    if (isset($_GET['GradeLevel']) && isset($_GET['SectionName'])) {
                                      $subjectRowCount = sizeof($subjects);
                                      while ($rowCount != $subjectRowCount) { ?>
                                        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="AssignScheduleForm">
                                          <tr>
                                            <td><?php echo $rowCount; ?></td>
                                            <td>
                                              <?php echo $subjects[$rowCount]['subjectName']; ?>
                                              <input type="hidden" name="subjectname" value="<?php echo $subjects[$rowCount]['subjectName']; ?>">
                                            </td>
                                            <td>
                                              <?php
                                              $getAssignedFaculty = $mysqli->query("SELECT * FROM workschedule 
                                                                                    WHERE SR_grade = '{$_GET['GradeLevel']}' 
                                                                                    AND SR_section = '{$_GET['SectionName']}' 
                                                                                    AND acadYear = '{$currentSchoolYear}'
                                                                                    AND S_subject = '{$subjects[$rowCount]['subjectName']}'");
                                              $assignedFaculty = $getAssignedFaculty->fetch_assoc();
                                              ?>
                                              <input type="hidden" name="WS_ID" value="<?php echo $assignedFaculty['WS_ID']; ?>">
                                              <select class="form-select" name="assignedFaculty" aria-label="Default select example" required>
                                                <?php
                                                if (mysqli_num_rows($getAssignedFaculty) > 0) {
                                                  $getFacultyName = $mysqli->query("SELECT F_lname, F_fname, F_mname, F_suffix FROM faculty WHERE F_number = '{$assignedFaculty['F_number']}'");
                                                  $FacultyName = $getFacultyName->fetch_assoc();
                                                ?>
                                                  <option value="<?php echo $assignedFaculty['F_number'] ?>" selected><?php echo $FacultyName['F_lname'] . ", " . $FacultyName['F_fname'] . " " . substr($FacultyName['F_mname'], 0, 1) . ". " . $FacultyName['F_suffix'] . "." ?></option>
                                                  <option></option>
                                                <?php } else { ?>
                                                  <option selected>Available Teachers</option>
                                                  <option></option>
                                                <?php }
                                                ?>

                                                <?php
                                                $listFacultyData = $mysqli->query("SELECT F_number, F_lname, F_fname, F_mname, F_suffix FROM faculty ORDER BY F_lname");
                                                while ($listFaculty = $listFacultyData->fetch_assoc()) { ?>
                                                  <option value="<?php echo $listFaculty['F_number'] ?>"><?php echo $listFaculty['F_lname'] . ", " . $listFaculty['F_fname'] . " " . substr($listFaculty['F_mname'], 0, 1) . ". " . $listFaculty['F_suffix'] . "." ?></option>
                                                <?php }
                                                ?>
                                              </select>
                                            </td>
                                            <td>
                                              <?php
                                              if (empty($schedule[$rowCount]['WS_start_time'])) {
                                                echo '<input type="time" class="form-control" name="WS_start_time" required>';
                                              } else {
                                                echo '<input type="time" class="form-control" name="WS_start_time" value=' . $schedule[$rowCount]['WS_start_time'] . ' required>';
                                              }
                                              ?>
                                            </td>
                                            <td>
                                              <?php
                                              if (empty($schedule[$rowCount]['WS_start_time'])) {
                                                echo '<input type="time" class="form-control" name="WS_end_time" required>';
                                              } else {
                                                echo '<input type="time" class="form-control" name="WS_end_time" value=' . timePlusOneMinute($schedule[$rowCount]['WS_end_time']) . ' required>';
                                              }
                                              ?>
                                            </td>
                                            <td>

                                              <?php
                                              if (empty($schedule[$rowCount]['F_number'])) { ?>
                                                <input type="submit" class="btn btn-primary" name="setSchedule" id="setSchedule" value="SET">
                                              <?php
                                              } else {
                                              ?>
                                                <!-- <input type="submit" class="btn btn-primary" name="updateSchedule" id="updateSchedule" value="UPD"> -->
                                                <input type="submit" class="btn btn-primary" name="deleteSchedule" id="deleteSchedule" value="DELETE SCHEDULE">
                                              <?php }
                                              ?>
                                            </td>
                                          </tr>
                                        </form>
                                      <?php $rowCount++;
                                      }
                                    } else { ?>
                                      <tr>
                                        <td colspan="10">NO GRADE AND SECTION SELECTED</td>
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
</body>

</html>