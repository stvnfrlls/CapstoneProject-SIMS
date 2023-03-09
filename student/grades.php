<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['SR_number'])) {
    header('Location: ../auth/login.php');
} else {
    $studentInformation = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
    $studentData = $studentInformation->fetch_assoc();

    $GradeSection = $mysqli->query("SELECT * FROM sections WHERE S_yearLevel = '{$studentData['SR_grade']}' AND S_name = '{$studentData['SR_section']}' AND acadYear = '{$currentSchoolYear}'");
    $GradeSectionData = $GradeSection->fetch_assoc();

    $Faculty = $mysqli->query("SELECT F_lname, F_fname, F_mname, F_suffix FROM faculty WHERE F_number = '{$GradeSectionData['S_adviser']}'");
    $FacultyData = $Faculty->fetch_assoc();

    $getStudentGrades = "SELECT * FROM grades WHERE SR_number = '{$_SESSION['SR_number']}' AND acadYear = '{$currentSchoolYear}'";
    $resultgetStudentGrades = $mysqli->query($getStudentGrades);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Report Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
    </nav>
    <!-- Navbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars" style="color:white;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <style>
                @media (max-width: 991.98px) {
                    .navbar-nav {
                        margin-left: 0px !important;
                    }

                    .navbar .navbar-nav .nav-link {
                        margin-left: 0px !important;
                    }
                }
            </style>
            <div class="navbar-nav m-auto p-4 p-lg-0 ">
                <a href="../index.php" class="nav-item nav-link active" style="color: white; font-size: 14px;">Home</a>
                <a href="../about.php" class="nav-item nav-link" style="color: white; font-size: 14px;">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown" style="color: white; font-size: 14px;">Menu <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu bg-dark border-0 m-0">
                        <a href="../student/dashboard.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Dashboard</a>
                        <a href="../student/profile.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Profile</a>
                        <a href="../student/grades.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Report Card</a>
                        <a href="../student/dailyAttendance.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Attendance</a>
                        <a href="../student/reminders.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Reminders</a>
                        <a href="../student/announcement.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">School Announcements</a>
                        <a href="../auth/logout.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Logout</a>
                    </div>
                </div>
                <a href="../faculty.php" class="nav-item nav-link" style="color: white; font-size: 14px;">Faculty Directory</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="home-tab" style="margin-top: 0px !important;">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview">
                            <style>
                                table tr:nth-child(even) {
                                    background-color: #f4f5f7;
                                    /* border-color: #0a0000; */
                                }

                                table tr:nth-child(odd) {
                                    background-color: #f4f5f7;
                                    /* border-color: #070000; */
                                }
                            </style>
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="text-uppercase text-center" style="padding-top: 40px;">Report Card</h2>
                                        <p style="text-align: center;">School Year: <?php echo $currentSchoolYear ?></p>
                                        <?php
                                        if (mysqli_num_rows($resultgetStudentGrades) > 0) { ?>
                                            <div class="btn-group m-3">
                                                <div style="text-align: right;">
                                                    <a href="../reports/ReportCard.php?ID=<?php echo  $studentData['SR_number'] ?>" class="btn btn-light" style=" text-align:center; font-size: 13px">Print <i class="fa fa-print" style="font-size: 12px;"></i></a>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-12 grid-margin">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6 grid-margin">
                                            <div class="card">
                                                <div class="card-body" style="text-align: left;">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-lg-6">
                                                            <p>
                                                                Name: <?php echo $studentData['SR_lname'] . ", " . $studentData['SR_fname'] . " " . substr($studentData['SR_mname'], 0, 1) ?>
                                                            </p>

                                                        </div>
                                                        <div class="col-sm-12 col-lg-6">

                                                            <p>Student Number: <?php echo $studentData['SR_number']; ?></p>
                                                            </p>

                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-lg-6">
                                                            <p>
                                                                Grade and Section: <?php echo $GradeSectionData['S_yearLevel'] . " - " . $GradeSectionData['S_name']; ?>
                                                            </p>

                                                        </div>
                                                        <div class="col-sm-12 col-lg-6">

                                                            <p>
                                                                <?php
                                                                if (mysqli_num_rows($Faculty) > 0) {
                                                                    echo "Adviser: " . $FacultyData['F_lname'] . ", " . $FacultyData['F_fname'] . " " . substr($FacultyData['F_mname'], 0, 1);
                                                                } else {
                                                                    echo "Adviser: NO ADVISER ASSIGNED YET";
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table text-center">
                                                        <thead style="  background-color: #f4f5f7 ;">
                                                            <tr>
                                                                <th rowspan="2" class="hatdog">Subject</th>
                                                                <th colspan="4" class="hatdog">Quarter</th>
                                                                <th rowspan="2" class="hatdog">Final Grade</th>
                                                                <th rowspan="2" class="hatdog">Remarks</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="hatdog">1</td>
                                                                <td class="hatdog">2</td>
                                                                <td class="hatdog">3</td>
                                                                <td class="hatdog">4</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody style=" background-color: #f4f5f7 !important;">
                                                            <?php
                                                            $studentGrades = $mysqli->query("SELECT * FROM grades WHERE SR_number = '{$_SESSION['SR_number']}' AND acadYear = '{$currentSchoolYear}'");

                                                            if (mysqli_num_rows($studentGrades) > 0) {
                                                                while ($studentGradesData = $studentGrades->fetch_assoc()) { ?>
                                                                    <tr>
                                                                        <td class="hatdog"><?php echo $studentGradesData['G_learningArea']; ?></td>
                                                                        <?php
                                                                        if ($studentGradesData['G_gradesQ1']) { ?>
                                                                            <td class="hatdog"><?php echo $studentGradesData['G_gradesQ1']; ?></td>
                                                                        <?php
                                                                        } else { ?>
                                                                            <td class="hatdog"></td>
                                                                        <?php } ?>

                                                                        <?php
                                                                        if ($studentGradesData['G_gradesQ2']) { ?>
                                                                            <td class="hatdog"><?php echo $studentGradesData['G_gradesQ2']; ?></td>
                                                                        <?php
                                                                        } else { ?>
                                                                            <td class="hatdog"></td>
                                                                        <?php } ?>

                                                                        <?php
                                                                        if ($studentGradesData['G_gradesQ3']) { ?>
                                                                            <td class="hatdog"><?php echo $studentGradesData['G_gradesQ3']; ?></td>
                                                                        <?php
                                                                        } else { ?>
                                                                            <td class="hatdog"></td>
                                                                        <?php } ?>

                                                                        <?php
                                                                        if ($studentGradesData['G_gradesQ4']) { ?>
                                                                            <td class="hatdog"><?php echo $studentGradesData['G_gradesQ4']; ?></td>
                                                                        <?php
                                                                        } else { ?>
                                                                            <td class="hatdog"></td>
                                                                        <?php } ?>

                                                                        <td class="hatdog">
                                                                            <?php
                                                                            if (empty($studentGradesData['G_finalgrade'])) {
                                                                                $sum = $studentGradesData['G_gradesQ1'] + $studentGradesData['G_gradesQ2'] + $studentGradesData['G_gradesQ3'] + $studentGradesData['G_gradesQ4'];
                                                                                $average = $sum / 4;
                                                                                echo round($average);
                                                                            } else {
                                                                                echo $studentGradesData['G_finalgrade'];
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td class="hatdog">
                                                                            <?php
                                                                            $average = $studentGradesData['G_finalgrade'];
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
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php }
                                                            } else {
                                                                if ($GradeSectionData['S_yearLevel'] == "KINDER") {
                                                                    $yearLevel = 0;
                                                                } else {
                                                                    $yearLevel = $GradeSectionData['S_yearLevel'];
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

                                                <div class="row">
                                                    <div class="col-12" style="float:right;">
                                                        <table id="ave" class="table text-center" style="margin-top: 20px; margin-bottom: 20px;">
                                                            <tr>
                                                                <td class="hatdog">General Average</td>
                                                                <td class="hatdog">
                                                                    <?php
                                                                    $GenAveQuery = $mysqli->query("SELECT round(avg(G_finalgrade)) FROM grades WHERE SR_number = '{$_SESSION['SR_number']}' AND acadYear = '{$currentSchoolYear}'");
                                                                    $GetgenAve = $GenAveQuery->fetch_assoc();
                                                                    echo $GetgenAve['round(avg(G_finalgrade))'];
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 grid-margin">
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
                                    <div class="col-12">
                                        <div class="card" style="margin-top: 30px;">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2" class="hatdog" style="border-color: #FFFFFF;">Core Values</th>
                                                                <th rowspan="2" class="hatdog" style="border-color: #FFFFFF;">Behavior Statements</th>
                                                                <th colspan="4" class="hatdog" style="border-color: #FFFFFF;">Periodic Rating</th>
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
                                                            $getBehaviorData = $mysqli->query("SELECT SR_number, CV_Area, CV_valueQ1, CV_valueQ2, CV_valueQ3, CV_valueQ4
                                                                  FROM behavior WHERE SR_number = '{$_SESSION['SR_number']}' AND acadYear = '{$currentSchoolYear}'");
                                                            $getBehaviorAreas = $mysqli->query("SELECT * FROM behavior_category");
                                                            $BehaviorAreasArray = array();
                                                            while ($DataBehaviorCategory = $getBehaviorAreas->fetch_assoc()) {
                                                                $BehaviorAreasArray[] = $DataBehaviorCategory;
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($getBehaviorData->num_rows > 0) {
                                                                $i = 0;
                                                                while ($BehaviorData = $getBehaviorData->fetch_assoc()) { ?>
                                                                    <tr>
                                                                        <?php if ($i % 2 == 0) { ?>
                                                                            <td rowspan="2" class="hatdog">
                                                                                <?php echo preg_replace('/[0-9]/', '', $BehaviorAreasArray[$i]['core_value_area']); ?>
                                                                            </td>
                                                                        <?php } ?>

                                                                        <td rowspan="1" class="hatdog">
                                                                            <?php echo $BehaviorAreasArray[$i]['core_value_subheading']; ?>
                                                                        </td>
                                                                        <td rowspan="1" class="hatdog"><?php echo $BehaviorData['CV_valueQ1']; ?>
                                                                        </td>
                                                                        <td rowspan="1" class="hatdog"><?php echo $BehaviorData['CV_valueQ2']; ?>
                                                                        </td>
                                                                        <td rowspan="1" class="hatdog"><?php echo $BehaviorData['CV_valueQ3']; ?>
                                                                        </td>
                                                                        <td rowspan="1" class="hatdog"><?php echo $BehaviorData['CV_valueQ4']; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php $i++;
                                                                }
                                                            } else {
                                                                $getBehaviorLabels = $mysqli->query("SELECT * FROM behavior_category");
                                                                $i = 0;
                                                                while ($BehaviorLabel = $getBehaviorLabels->fetch_assoc()) { ?>
                                                                    <tr>
                                                                        <?php
                                                                        if ($i % 2 == 0) { ?>
                                                                            <td rowspan="2" class="hatdog">
                                                                                <?php echo preg_replace('/[0-9]/', '', $BehaviorLabel['core_value_area']); ?>
                                                                            </td>
                                                                        <?php } ?>
                                                                        <td class="hatdog"><?php echo $BehaviorLabel['core_value_subheading'] ?></td>
                                                                        <td class="hatdog"></td>
                                                                        <td class="hatdog"></td>
                                                                        <td class="hatdog"></td>
                                                                        <td class="hatdog"></td>
                                                                    </tr>
                                                                <?php
                                                                    $i++;
                                                                }
                                                                ?>
                                                            <?php }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="row" style="margin-top: 20px;">
                                                    <div>
                                                        <div class="container">
                                                            <div id="remarkshead" class="row fw-bold">
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
                                </div>



                                <div class="row">
                                    <div>
                                        <div class="card" style="margin-top: 30px;">
                                            <div class="card-body">
                                                <div class="">
                                                    <div class="table-responsive">
                                                        <table class="table text-center">
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
                                                                    <td class="hatdog"><?php echo countWeekdays(9, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(10, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(11, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(12, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(1, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(2, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(3, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(4, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(5, date('Y')) ?></td>
                                                                    <td class="hatdog"><?php echo countWeekdays(6, date('Y')) ?></td>
                                                                    <td class="hatdog">223</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="hatdog">No. of Days Present</td>
                                                                    <?php
                                                                    $SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'September' AND acadYear = '{$currentSchoolYear}'");
                                                                    $SEPvalue = $SEP->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $SEPvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'October' AND acadYear = '{$currentSchoolYear}'");
                                                                    $OCTvalue = $OCT->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $OCTvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'November' AND acadYear = '{$currentSchoolYear}'");
                                                                    $NOVvalue = $NOV->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $NOVvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'December' AND acadYear = '{$currentSchoolYear}'");
                                                                    $DECvalue = $DEC->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $DECvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'January' AND acadYear = '{$currentSchoolYear}'");
                                                                    $JANvalue = $JAN->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $JANvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'February' AND acadYear = '{$currentSchoolYear}'");
                                                                    $FEBvalue = $FEB->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $FEBvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'March' AND acadYear = '{$currentSchoolYear}'");
                                                                    $MARvalue = $MAR->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $MARvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'April' AND acadYear = '{$currentSchoolYear}'");
                                                                    $APRvalue = $APR->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $APRvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'May' AND acadYear = '{$currentSchoolYear}'");
                                                                    $MAYvalue = $MAY->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $MAYvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'June' AND acadYear = '{$currentSchoolYear}'");
                                                                    $JUNvalue = $JUN->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $JUNvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $TOTAL = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND acadYear = '{$currentSchoolYear}'");
                                                                    $TOTALvalue = $TOTAL->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $TOTALvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td class="hatdog">No. of Days Absent</td>
                                                                    <?php
                                                                    $SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'September' AND A_status = 'ABSENT'");
                                                                    $SEPvalue = $SEP->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $SEPvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'October' AND A_status = 'ABSENT'");
                                                                    $OCTvalue = $OCT->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $OCTvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'November' AND A_status = 'ABSENT'");
                                                                    $NOVvalue = $NOV->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $NOVvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'December' AND A_status = 'ABSENT'");
                                                                    $DECvalue = $DEC->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $DECvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'January' AND A_status = 'ABSENT'");
                                                                    $JANvalue = $JAN->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $JANvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'February' AND A_status = 'ABSENT'");
                                                                    $FEBvalue = $FEB->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $FEBvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'March' AND A_status = 'ABSENT'");
                                                                    $MARvalue = $MAR->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $MARvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'April' AND A_status = 'ABSENT'");
                                                                    $APRvalue = $APR->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $APRvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'May' AND A_status = 'ABSENT'");
                                                                    $MAYvalue = $MAY->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $MAYvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'June' AND A_status = 'ABSENT'");
                                                                    $JUNvalue = $JUN->fetch_assoc();
                                                                    echo '<td class="hatdog">' . $JUNvalue['COUNT(A_time_IN)'] . '</td>';
                                                                    $TOTALLATE = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND A_status = 'ABSENT' ");
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
            </div>
        </div>
    </div>


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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>

</body>

</html>