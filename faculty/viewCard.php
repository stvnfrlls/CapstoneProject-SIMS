<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else {
  if ($_GET['ID']) {
    $getStudentRecord = "SELECT * FROM studentrecord WHERE SR_number = '{$_GET['ID']}'";
    $rungetStudentRecord = $mysqli->query($getStudentRecord);
    $StudentData = $rungetStudentRecord->fetch_assoc();

    $getSectionInfo = "SELECT * FROM sections WHERE S_adviser = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}'";
    $rungetSectionInfo = $mysqli->query($getSectionInfo);
    $SectionData = $rungetSectionInfo->fetch_assoc();

    $getSectionClassList = "SELECT SR_number FROM studentrecord WHERE SR_section = '{$SectionData['S_name']}'";
    $rungetSectionClassList = $mysqli->query($getSectionClassList);

    $getFacultyName = "SELECT * FROM faculty WHERE F_number = '{$_SESSION['F_number']}'";
    $rungetFacultyName = $mysqli->query($getFacultyName);
    $FacultyData = $rungetFacultyName->fetch_assoc();

    $getStudentGrades = "SELECT * FROM grades WHERE SR_number = '{$_GET['ID']}' AND acadYear = '{$currentSchoolYear}'";
    $rungetStudentGrades = $mysqli->query($getStudentGrades);

    $getBehaviorData = $mysqli->query("SELECT SR_number, CV_Area, CV_valueQ1, CV_valueQ2, CV_valueQ3, CV_valueQ4
                                      FROM behavior WHERE SR_number = '{$_GET['ID']}' AND acadYear = '{$currentSchoolYear}'");
    $getBehaviorAreas = $mysqli->query("SELECT * FROM behavior_category");
    $BehaviorAreasArray = array();
    while ($DataBehaviorCategory = $getBehaviorAreas->fetch_assoc()) {
      $BehaviorAreasArray[] = $DataBehaviorCategory;
    }
  } else {
    header('Location: advisoryPage.php');
  }
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
  <link href="../assets/css/admin/style.css" rel="stylesheet">
  <link href="../assets/css/admin/style.css.map" rel="stylesheet">

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
              <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                      <h2 class="fw-bold text-primary text-uppercase">STUDENT REPORT CARD</h2>
                    </div>
                  </div>
                  <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                    <nav class="nav">
                      <a class="nav-link active ms-0" href="viewStudent.php?ID=<?php echo $_GET['ID'] ?>">Profile</a>
                      <a class="nav-link" href="viewCard.php?ID=<?php echo $_GET['ID'] ?>"  style="color: #c02628;">Report Card</a>
                    </nav>
                    <div class="border-bottom"></div>
                  </div>
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-12 grid-margin">
                          <div class="btn-group" style="margin-bottom: 10px;">
                            <div>
                              <?php
                              if (mysqli_num_rows($rungetStudentGrades) > 0) { ?>
                                <a href="../reports/ReportCard.php?ID=<?php echo $_GET['ID'] ?>" class="btn btn-light" style="border-color: #e4e3e3; background-color:#e4e3e3; text-align:center; font-size: 13px">Print <i class="fa fa-print" style="font-size: 12px;"></i></a>
                              <?php } else { ?>
                                <a href="viewCard.php?ID=<?php echo $_GET['ID'] ?>" class="btn btn-light" style="border-color: #e4e3e3; background-color:#e4e3e3; text-align:center; font-size: 13px">Print <i class="fa fa-print" style="font-size: 12px;"></i></a>
                              <?php }
                              ?>

                            </div>
                          </div>
                          <div class="btn-group" style="float: right;">
                            <?php
                            $studentLink = array();
                            while ($ClassListData = $rungetSectionClassList->fetch_assoc()) {
                              $studentLink[] = $ClassListData['SR_number'];
                            }
                            $value = $_GET['ID'];
                            $index = array_search($value, $studentLink);
                            if ($index !== false) {
                              if ($index > 0) {
                                $previous = $studentLink[$index - 1];
                              }
                              if ($index < count($studentLink) - 1) {
                                $next = $studentLink[$index + 1];
                              }
                            }
                            ?>
                            <a href="viewCard.php?ID=<?php echo $previous ?>" class="btn btn-light" style="border-color: #e4e3e3; background-color:#e4e3e3; text-align:center; font-size: 13px"><i class="fa fa-angle-double-left"></i> Previous</a>
                            <a href="viewCard.php?ID=<?php echo $next ?>" class="btn btn-light" style="border-color: #e4e3e3; background-color:#e4e3e3; text-align:center; font-size: 13px; float: right;">Next <i class="fa fa-angle-double-right"></i></a>
                          </div>
                          <div class="row">
                            <div class="col-sm-12 col-lg-8 grid-margin">
                              <div class="card">
                                <div class="card-body" style="text-align: left;">
                                  <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                      <p>
                                        <?php echo "NAME: " . $StudentData['SR_lname'] . ", " . $StudentData['SR_fname'] . " " . substr($StudentData['SR_mname'], 0, 1); ?>
                                      </p>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                      <p><?php echo "STUDENT NUMBER: " . $StudentData['SR_number'] ?></p>
                                      </p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                      <p>
                                        <?php echo "Grade and Section: " . $StudentData['SR_grade'] . " - " . $StudentData['SR_section'] ?>
                                      </p>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">

                                      <p>
                                        <?php
                                        echo "Adviser: " . $FacultyData['F_lname'] . ", " . $FacultyData['F_fname'] . " " . substr($FacultyData['F_mname'], 0, 1);
                                        ?>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="table-responsive">
                                  <table class="table text-center">
                                    <thead style=" background-color: #f4f5f7 !important;">
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
                                    <tbody style="  background-color: #f4f5f7 ;">
                                      <?php
                                      $average = null;
                                      if (mysqli_num_rows($rungetStudentGrades) > 0) {
                                        while ($StudentGrades = $rungetStudentGrades->fetch_assoc()) { ?>
                                          <tr>
                                            <td class="hatdog"><?php echo $StudentGrades['G_learningArea']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_gradesQ1']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_gradesQ2']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_gradesQ3']; ?></td>
                                            <td class="hatdog"><?php echo $StudentGrades['G_gradesQ4']; ?></td>
                                            <td class="hatdog">
                                              <?php
                                              if (isset($StudentGrades['G_gradesQ4'])) {
                                                $sum = $StudentGrades['G_gradesQ1'] + $StudentGrades['G_gradesQ2'] + $StudentGrades['G_gradesQ3'] + $StudentGrades['G_gradesQ4'];
                                                $average = $sum / 4;
                                                echo round($average);
                                              }
                                              ?>
                                            </td>
                                            <td class="hatdog">
                                              <?php
                                              if (isset($StudentGrades['G_gradesQ4'])) {
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
                                                }
                                              }
                                              ?>
                                            </td>
                                          </tr>
                                        <?php }
                                      } else {
                                        if ($SectionData['S_yearLevel'] == "KINDER") {
                                          $yearLevel = 0;
                                        } else {
                                          $yearLevel = $SectionData['S_yearLevel'];
                                        }
                                        $getLearningAreas = $mysqli->query("SELECT * FROM subjectperyear WHERE minYearLevel <= '{$yearLevel}' AND maxYearLevel >= '{$yearLevel}'");
                                        while ($LearningAreas = $getLearningAreas->fetch_assoc()) { ?>
                                          <tr>
                                            <td class="hatdog"><?php echo $LearningAreas['subjectName'] ?></td>
                                            <td class="hatdog"></td>
                                            <td class="hatdog"></td>
                                            <td class="hatdog"></td>
                                            <td class="hatdog"></td>
                                            <td class="hatdog"></td>
                                            <td class="hatdog"></td>
                                          </tr>
                                        <?php
                                        }
                                        ?>
                                      <?php }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="row" style="--bs-gutter-x: 14px; --bs-gutter-y: 10px;">
                                  <table id="ave" class="table text-center">
                                    <tr>
                                      <td class="hatdog"> General Average</td>
                                      <td class="hatdog"><?php echo round($average); ?></td>
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
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h3 style="text-align: center;">CHARACTER BUILDING</h3>
                            <div class="row">
                              <div class="">
                                <button type="submit" name="saveBehavior" class="btn btn-primary">Submit</button>
                              </div>
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
                                    if ($getBehaviorData->num_rows > 0) {
                                      $i = 0;
                                      while ($BehaviorData = $getBehaviorData->fetch_assoc()) { ?>
                                        <tr>
                                          <input type="hidden" name="row[]" value="<?php echo $i; ?>">
                                          <input type="hidden" name="CV_Area[]" value="<?php echo $BehaviorAreasArray[$i]['core_value_area']; ?>">
                                          <input type="hidden" name="SR_grade" value="<?php echo $StudentData['SR_grade']; ?>">
                                          <input type="hidden" name="SR_section" value="<?php echo $StudentData['SR_section']; ?>">
                                          <?php if ($i % 2 == 0) { ?>
                                            <td rowspan="2" class="hatdog">
                                              <?php echo preg_replace('/[0-9]/', '', $BehaviorAreasArray[$i]['core_value_area']); ?>
                                            </td>
                                          <?php } ?>

                                          <td rowspan="1" class="hatdog">
                                            <?php echo $BehaviorAreasArray[$i]['core_value_subheading']; ?>
                                          </td>
                                          <td rowspan="1" class="hatdog">
                                            <?php
                                            $checkQuarter1 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 1 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter1) == 1) {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ1[]" value="' . $BehaviorData['CV_valueQ1'] . '" size="2">';
                                            } else {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ1[]" value="' . $BehaviorData['CV_valueQ1'] . '" size="2" disabled>';
                                            }
                                            ?>
                                          </td>
                                          <td rowspan="1" class="hatdog">
                                            <?php
                                            $checkQuarter2 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 2 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter2) == 1) {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ2[]" value="' . $BehaviorData['CV_valueQ2'] . '" size="2">';
                                            } else {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ2[]" value="' . $BehaviorData['CV_valueQ2'] . '" size="2" disabled>';
                                            }
                                            ?>
                                          </td>
                                          <td rowspan="1" class="hatdog">
                                            <?php
                                            $checkQuarter3 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 3 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter3) == 1) {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ3[]" value="' . $BehaviorData['CV_valueQ3'] . '" size="2">';
                                            } else {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ3[]" value="' . $BehaviorData['CV_valueQ3'] . '" size="2" disabled>';
                                            }
                                            ?>
                                          </td>
                                          <td rowspan="1" class="hatdog">
                                            <?php
                                            $checkQuarter4 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 4 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter4) == 1) {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ4[]" value="' . $BehaviorData['CV_valueQ4'] . '" size="2">';
                                            } else {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ4[]" value="' . $BehaviorData['CV_valueQ4'] . '" size="2" disabled>';
                                            }
                                            ?>
                                          </td>
                                        </tr>
                                      <?php $i++;
                                      }
                                    } else {
                                      $getBehaviorLabels = $mysqli->query("SELECT * FROM behavior_category");
                                      $i = 0;
                                      while ($BehaviorLabel = $getBehaviorLabels->fetch_assoc()) { ?>
                                        <tr>
                                          <input type="hidden" name="row[]" value="<?php echo $i; ?>">
                                          <input type="hidden" name="CV_Area[]" value="<?php echo $BehaviorAreasArray[$i]['core_value_area']; ?>">
                                          <input type="hidden" name="SR_grade" value="<?php echo $StudentData['SR_grade']; ?>">
                                          <input type="hidden" name="SR_section" value="<?php echo $StudentData['SR_section']; ?>">
                                          <?php
                                          if ($i % 2 == 0) { ?>
                                            <td rowspan="2" class="hatdog">
                                              <?php echo preg_replace('/[0-9]/', '', $BehaviorLabel['core_value_area']); ?>
                                            </td>
                                          <?php } ?>
                                          <td class="hatdog"><?php echo $BehaviorLabel['core_value_subheading'] ?></td>
                                          <td class="hatdog">
                                            <?php
                                            $checkQuarter1 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 1 AND quarterFormStatus = 'enabled'");
                                            if (mysqli_num_rows($checkQuarter1) == 1) {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ1[]" size="2">';
                                            } else {
                                              echo '<input type="text" class="hatdog" name="CV_valueQ1[]" size="2" disabled>';
                                            }
                                            ?>
                                          </td>
                                          <td class="hatdog"><input type="text" class="hatdog" name="CV_valueQ2[]" size="2" disabled></td>
                                          <td class="hatdog"><input type="text" class="hatdog" name="CV_valueQ3[]" size="2" disabled></td>
                                          <td class="hatdog"><input type="text" class="hatdog" name="CV_valueQ4[]" size="2" disabled></td>
                                        </tr>
                                    <?php
                                        $i++;
                                      }
                                    }
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
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h3 style="text-align: center;">ATTENDANCE RECORD</h3>
                            <div class="row">
                              <div class="">
                                <div class="table-responsive">
                                  <table class="table text-center" style="margin-top: 30px;">
                                    <thead>
                                      <tr>
                                        <th class="hatdog" style="border-color: #FFFFFF;"></th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">SEP</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">OCT</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">NOV</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">DEC</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">JAN</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">FEB</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">MAR</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">APR</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">MAY</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">JUN</th>
                                        <th class="hatdog" style="border-color: #FFFFFF;">TOTAL</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="hatdog">No. of School Days</td>
                                        <td class="hatdog">22</td>
                                        <td class="hatdog">26</td>
                                        <td class="hatdog">23</td>
                                        <td class="hatdog">16</td>
                                        <td class="hatdog">15</td>
                                        <td class="hatdog">22</td>
                                        <td class="hatdog">27</td>
                                        <td class="hatdog">22</td>
                                        <td class="hatdog">24</td>
                                        <td class="hatdog">26</td>
                                        <td class="hatdog">223</td>
                                      </tr>
                                      <tr>
                                        <td class="hatdog">No. of Days Present</td>
                                        <?php
                                        $SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'September' AND acadYear = '{$currentSchoolYear}'");
                                        $SEPvalue = $SEP->fetch_assoc();
                                        echo '<td class="hatdog">' . $SEPvalue['COUNT(A_time_IN)'] . '</td>';
                                        $OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'October' AND acadYear = '{$currentSchoolYear}'");
                                        $OCTvalue = $OCT->fetch_assoc();
                                        echo '<td class="hatdog">' . $OCTvalue['COUNT(A_time_IN)'] . '</td>';
                                        $NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'November' AND acadYear = '{$currentSchoolYear}'");
                                        $NOVvalue = $NOV->fetch_assoc();
                                        echo '<td class="hatdog">' . $NOVvalue['COUNT(A_time_IN)'] . '</td>';
                                        $DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'December' AND acadYear = '{$currentSchoolYear}'");
                                        $DECvalue = $DEC->fetch_assoc();
                                        echo '<td class="hatdog">' . $DECvalue['COUNT(A_time_IN)'] . '</td>';
                                        $JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'January' AND acadYear = '{$currentSchoolYear}'");
                                        $JANvalue = $JAN->fetch_assoc();
                                        echo '<td class="hatdog">' . $JANvalue['COUNT(A_time_IN)'] . '</td>';
                                        $FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'February' AND acadYear = '{$currentSchoolYear}'");
                                        $FEBvalue = $FEB->fetch_assoc();
                                        echo '<td class="hatdog">' . $FEBvalue['COUNT(A_time_IN)'] . '</td>';
                                        $MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'March' AND acadYear = '{$currentSchoolYear}'");
                                        $MARvalue = $MAR->fetch_assoc();
                                        echo '<td class="hatdog">' . $MARvalue['COUNT(A_time_IN)'] . '</td>';
                                        $APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'April' AND acadYear = '{$currentSchoolYear}'");
                                        $APRvalue = $APR->fetch_assoc();
                                        echo '<td class="hatdog">' . $APRvalue['COUNT(A_time_IN)'] . '</td>';
                                        $MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'May' AND acadYear = '{$currentSchoolYear}'");
                                        $MAYvalue = $MAY->fetch_assoc();
                                        echo '<td class="hatdog">' . $MAYvalue['COUNT(A_time_IN)'] . '</td>';
                                        $JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'June' AND acadYear = '{$currentSchoolYear}'");
                                        $JUNvalue = $JUN->fetch_assoc();
                                        echo '<td class="hatdog">' . $JUNvalue['COUNT(A_time_IN)'] . '</td>';
                                        $TOTAL = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND acadYear = '{$currentSchoolYear}'");
                                        $TOTALvalue = $TOTAL->fetch_assoc();
                                        echo '<td class="hatdog">' . $TOTALvalue['COUNT(A_time_IN)'] . '</td>';
                                        ?>
                                      </tr>
                                      <tr>
                                        <td class="hatdog">No. of Days Absent</td>
                                        <?php
                                        $SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'September' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $SEPvalue = $SEP->fetch_assoc();
                                        echo '<td class="hatdog">' . $SEPvalue['COUNT(A_time_IN)'] . '</td>';
                                        $OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'October' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $OCTvalue = $OCT->fetch_assoc();
                                        echo '<td class="hatdog">' . $OCTvalue['COUNT(A_time_IN)'] . '</td>';
                                        $NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'November' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $NOVvalue = $NOV->fetch_assoc();
                                        echo '<td class="hatdog">' . $NOVvalue['COUNT(A_time_IN)'] . '</td>';
                                        $DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'December' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $DECvalue = $DEC->fetch_assoc();
                                        echo '<td class="hatdog">' . $DECvalue['COUNT(A_time_IN)'] . '</td>';
                                        $JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'January' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $JANvalue = $JAN->fetch_assoc();
                                        echo '<td class="hatdog">' . $JANvalue['COUNT(A_time_IN)'] . '</td>';
                                        $FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'February' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $FEBvalue = $FEB->fetch_assoc();
                                        echo '<td class="hatdog">' . $FEBvalue['COUNT(A_time_IN)'] . '</td>';
                                        $MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'March' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $MARvalue = $MAR->fetch_assoc();
                                        echo '<td class="hatdog">' . $MARvalue['COUNT(A_time_IN)'] . '</td>';
                                        $APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'April' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $APRvalue = $APR->fetch_assoc();
                                        echo '<td class="hatdog">' . $APRvalue['COUNT(A_time_IN)'] . '</td>';
                                        $MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'May' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $MAYvalue = $MAY->fetch_assoc();
                                        echo '<td class="hatdog">' . $MAYvalue['COUNT(A_time_IN)'] . '</td>';
                                        $JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'June' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $JUNvalue = $JUN->fetch_assoc();
                                        echo '<td class="hatdog">' . $JUNvalue['COUNT(A_time_IN)'] . '</td>';
                                        $TOTALLATE = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                        $TOTALLATEvalue = $TOTALLATE->fetch_assoc();
                                        echo '<td class="hatdog">' . $TOTALLATEvalue['COUNT(A_time_IN)'] . '</td>';
                                        ?>
                                      </tr>
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

            </form>
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



  <!-- JavaScript Libraries -->


  <!-- Template Javascript -->
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/admin/vendor.bundle.base.js"></script>
  <script src="../assets/js/admin/off-canvas.js"></script>
  <script src="../assets/js/admin/file-upload.js"></script>

</body>

</html>