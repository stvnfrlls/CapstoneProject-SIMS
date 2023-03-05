<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else {
  $getClassList = "SELECT * FROM studentrecord 
                INNER JOIN grades
                ON studentrecord.SR_number = grades.SR_number
                WHERE studentrecord.SR_grade = '{$_GET['Grade']}'
                AND studentrecord.SR_section = '{$_GET['Section']}'
                AND grades.G_learningArea = '{$_GET['Subject']}'
                AND grades.acadYear = '{$currentSchoolYear}'";
  $getQuarter = $mysqli->query("SELECT * FROM quartertable");
  $arrayQuarter = array();

  while ($QuarterData = $getQuarter->fetch_assoc()) {
    $arrayQuarter[] = $QuarterData;
  }

  $FormQuery = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 'FORMS'");
  $FormStatus = $FormQuery->fetch_assoc();
  if ($FormStatus['quarterStatus'] == "enabled") { ?>
    <script>
      var inputElements = document.getElementsByTagName("input");
      for (var i = 1; i < inputElements.length; i++) {
        inputElements[i].disabled = false;
      }
    </script>
  <?php } else { ?>
    <script>
      var inputElements = document.getElementsByTagName("input");
      for (var i = 1; i < inputElements.length; i++) {
        inputElements[i].disabled = true;
      }
    </script>
<?php }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Faculty - Encode Grades</title>
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

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="../assets/css/sweetAlert.css" rel="stylesheet">

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
                    <h2 class="fw-bold text-primary text-uppercase">Encode Grades</h2>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div style="text-align: right; margin-bottom: 15px">
                      <button id="saveGrades" class="btn btn-primary me-2">Save</button>
                      <a href="" class="btn btn-light">Print <i class="fa fa-print" style="font-size: 12px; align-self:center;"></i></a>
                    </div>
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <div class="btn-group">
                              <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?php
                                if (isset($_GET['Grade']) && isset($_GET['Section'])) {
                                  if ($_GET['Grade'] == "KINDER") {
                                    echo $_GET['Grade'] . " - " . $_GET['Section'];
                                  } else {
                                    echo "Grade " . $_GET['Grade'] . " - " . $_GET['Section'];
                                  }
                                } else {
                                  echo "Grade and Section";
                                }
                                ?>
                                <i class="fa fa-caret-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <?php
                                $getGradeSectionData = $mysqli->query("SELECT DISTINCT SR_grade, SR_section FROM workschedule WHERE F_number = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}'");
                                while ($GradeSection = $getGradeSectionData->fetch_assoc()) { ?>
                                  <a class="dropdown-item" href="encodegrades.php?Grade=<?php echo $GradeSection['SR_grade'] ?>&Section=<?php echo $GradeSection['SR_section'] ?>">
                                    <?php
                                    if ($GradeSection['SR_grade'] == "KINDER") {
                                      echo $GradeSection['SR_grade'] . " - " . $GradeSection['SR_section'];
                                    } else {
                                      echo "Grade " . $GradeSection['SR_grade'] . " - " . $GradeSection['SR_section'];
                                    }
                                    ?>
                                  </a>
                                <?php
                                }
                                ?>
                              </div>
                            </div>
                            <div class="btn-group">
                              <button class="btn btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?php
                                if (isset($_GET['Subject'])) {
                                  echo $_GET['Grade'];
                                } else {
                                  echo "Subject";
                                }
                                ?>
                                <i class="fa fa-caret-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <?php
                                if (isset($_GET['Grade']) && isset($_GET['Section'])) {
                                  $getSubjectData = $mysqli->query("SELECT S_subject FROM workschedule 
                                                                        WHERE F_number = '{$_SESSION['F_number']}' 
                                                                        AND acadYear = '{$currentSchoolYear}'
                                                                        AND SR_grade = '{$_GET['Grade']}'
                                                                        AND SR_section = '{$_GET['Section']}'");
                                  while ($subjects = $getSubjectData->fetch_assoc()) { ?>
                                    <a class=" dropdown-item" href="encodegrades.php?Grade=<?php echo $_GET['Grade'] ?>&Section=<?php echo $_GET['Section'] ?>&Subject=<?php echo $subjects['S_subject']; ?>">
                                      <?php echo $subjects['S_subject']; ?>
                                    </a>
                                  <?php }
                                } else { ?>
                                  <a class=" dropdown-item" href="encodegrades.php"> </a>
                                <?php
                                }
                                ?>
                              </div>
                            </div>

                            <div class="row">
                              <div class="table-responsive">
                                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="FormGrades">
                                  <table class="table text-center" style="margin-top: 20px;">
                                    <thead>
                                      <tr>
                                        <th rowspan="2" class="hatdog">Student Name</th>
                                        <th colspan="4" class="hatdog">Quarter</th>
                                        <th rowspan="2" class="hatdog">Final Grade</th>
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
                                      if (isset($_GET['Grade']) && isset($_GET['Section']) && isset($_GET['Subject'])) {
                                        $rungetClassList = $mysqli->query($getClassList);
                                        $arrayClassList = array();

                                        while ($dataClassList = $rungetClassList->fetch_assoc()) {
                                          $arrayClassList[] = $dataClassList;
                                        }
                                        $rowCount = 0;
                                        $getClassListData = $mysqli->query("SELECT SR_number FROM classlist WHERE SR_grade = '{$_GET['Grade']}' AND SR_section = '{$_GET['Section']}' AND acadYear = '{$currentSchoolYear}'");
                                        while ($Classlist = $getClassListData->fetch_assoc()) { ?>
                                          <tr>
                                            <td class="hatdog">
                                              <?php
                                              $getStudentNameData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$Classlist['SR_number']}'");
                                              $StudentName = $getStudentNameData->fetch_assoc();

                                              echo $StudentName['SR_lname'] .  ", " . $StudentName['SR_fname'] . " " . substr($StudentName['SR_mname'], 0, 1) . ". " . $StudentName['SR_suffix'];
                                              ?>
                                              <input type="hidden" name="row[]" value="<?php echo $rowCount ?>">
                                              <input type="hidden" name="encodeGrade" value="submit">
                                              <input type="hidden" name="SR_number[]" value="<?php echo $Classlist['SR_number'] ?>">
                                              <input type="hidden" name="Grade[]" value="<?php echo  $StudentName['SR_grade'] ?>">
                                              <input type="hidden" name="Section[]" value="<?php echo $StudentName['SR_section'] ?>">
                                              <input type="hidden" name="Subject[]" value="<?php echo mysqli_escape_string($mysqli, $_GET['Subject']) ?>">
                                            </td>
                                            <?php
                                            $checkQuarter1 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 1 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter1) == 1) { ?>
                                              <td class="hatdog"><input type="number" maxlength="2" value="<?php echo $g1 = $arrayClassList[$rowCount]['G_gradesQ1']; ?>" name="G_gradesQ1[]" style="text-align: center; width: 30px;"></td>
                                            <?php } else { ?>
                                              <td class="hatdog"><input type="number" maxlength="2" value="<?php echo $g1 = $arrayClassList[$rowCount]['G_gradesQ1']; ?>" name="G_gradesQ1[]" style="text-align: center; width: 30px;" disabled></td>
                                            <?php } ?>

                                            <?php
                                            $checkQuarter2 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 2 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter2) == 1) { ?>
                                              <td class="hatdog"><input type="number" maxlength="2" value="<?php echo $g2 = $arrayClassList[$rowCount]['G_gradesQ2']; ?>" name="G_gradesQ2[]" style="text-align: center; width: 30px;"></td>
                                            <?php } else { ?>
                                              <td class="hatdog"><input type="number" maxlength="2" value="<?php echo $g2 = $arrayClassList[$rowCount]['G_gradesQ2']; ?>" name="G_gradesQ2[]" style="text-align: center; width: 30px;" disabled></td>
                                            <?php } ?>

                                            <?php
                                            $checkQuarter3 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 3 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter3) == 1) { ?>
                                              <td class="hatdog"><input type="number" maxlength="2" value="<?php echo $g3 = $arrayClassList[$rowCount]['G_gradesQ3']; ?>" name="G_gradesQ3[]" style="text-align: center; width: 30px;"></td>
                                            <?php } else { ?>
                                              <td class="hatdog"><input type="number" maxlength="2" value="<?php echo $g3 = $arrayClassList[$rowCount]['G_gradesQ3']; ?>" name="G_gradesQ3[]" style="text-align: center; width: 30px;" disabled></td>
                                            <?php } ?>

                                            <?php
                                            $checkQuarter4 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 4 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter4) == 1) { ?>
                                              <td class="hatdog"><input type="number" maxlength="2" value="<?php echo $g4 = $arrayClassList[$rowCount]['G_gradesQ4']; ?>" name="G_gradesQ4[]" style="text-align: center; width: 30px;"></td>
                                            <?php } else { ?>
                                              <td class="hatdog"><input type="number" maxlength="2" value="<?php echo $g4 = $arrayClassList[$rowCount]['G_gradesQ4']; ?>" name="G_gradesQ4[]" style="text-align: center; width: 30px;" disabled></td>
                                            <?php } ?>


                                            <td class="hatdog">
                                              <?php
                                              $average = 0;
                                              if (!empty($g4)) {
                                                $sum = intval($g1) + intval($g2) + intval($g3) + intval($g4);
                                                $average = $sum / 4;
                                                echo round($average);
                                              ?>
                                                <input type="hidden" name="FinalGrade[]" value="<?php echo round($average); ?>">
                                              <?php
                                              }
                                              ?>

                                            </td>
                                            <td class="hatdog">
                                              <?php
                                              if (!empty($average) || $average != 0) {
                                                if ($average >= 90) {
                                                  echo "Outstanding";
                                                } else if ($average >= 85 || $average <= 89) {
                                                  echo "Very Satisfactory";
                                                } else if ($average >= 80 || $average <= 84) {
                                                  echo "Satisfactory";
                                                } else if ($average >= 75 || $average <= 79) {
                                                  echo "Fairly Satisfactory";
                                                } else if ($average < 75) {
                                                  echo "Did Not Meet Expectations";
                                                } else if ($currentQuarter == 0) {
                                                  echo "Academic year not yeilt available";
                                                } else if ($g2 == 0 || $g3 == 0 || $g4 == 0) {
                                                  echo "Grades are incomplete";
                                                } else {
                                                  echo "Failed";
                                                }
                                              }
                                              ?>
                                            </td>
                                          </tr>
                                        <?php
                                          $rowCount++;
                                        }
                                        ?>
                                      <?php } else { ?>
                                        <tr>
                                          <td class="hatdog" colspan="7">Select a grade section first first</td>
                                        </tr>
                                      <?php }
                                      ?>
                                    </tbody>
                                  </table>
                                </form>
                              </div>

                              <div class="container">
                                <div id="remarkshead" class="row fw-bold" style="margin-top: 20px;">
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
  <button id="hatdog"> click hatdog </button>
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
  <script src="../assets/js/admin/file-upload.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
  <script>
    const FormGrades = document.getElementById('FormGrades');
    const saveGrades = document.getElementById('saveGrades');
    saveGrades.addEventListener('click', function() {
      Swal.fire({
        title: 'Are you sure you want save your changes?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Successfully changed!',
            icon: 'success',
          })
          FormGrades.submit();
        }
      })
    })
  </script>
</body>

</html>