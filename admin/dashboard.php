<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['AD_number'])) {
    header('Location: ../auth/login.php');
} else {
    $getAdminData = $mysqli->query("SELECT * FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminData = $getAdminData->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
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
    <link href="../assets/css/dashboard-admin.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css.map" rel="stylesheet">


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
                                <div class="d-sm-flex border-bottom">
                                    <div class="section-title position-relative">
                                        <h2 class="dashboard">Hi, <?php echo $AdminData['AD_name'] ?>!</h2>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-12 grid-margin">
                                                <form id="form-id" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                                    <button type="submit" name="acadyear" class="btn btn-primary m-2">Change School Year</button>

                                                    <?php
                                                    $EncodeStatus = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 'FORMS' AND quarterStatus = 'enabled'");
                                                    if (mysqli_num_rows($EncodeStatus) > 0) { ?>
                                                        <button type="submit" name="Close" class="btn btn-primary m-2">Close Forms</button>
                                                    <?php } else { ?>
                                                        <button type="submit" name="Open" class="btn btn-secondary m-2">Open Forms</button>
                                                    <?php } ?>

                                                    <?php
                                                    $checkQuarter1 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 1 AND quarterStatus = 'current'");
                                                    if (mysqli_num_rows($checkQuarter1) > 0) { ?>
                                                        <button type=" submit" class="btn btn-primary m-2" name="disableQ1">1st Quarter (CURRENT)</button>
                                                    <?php } else { ?>
                                                        <button type=" submit" class="btn btn-secondary m-2" name="enableFirst">Enable 1st Quarter</button>
                                                    <?php } ?>

                                                    <?php
                                                    $checkQuarter2 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 2 AND quarterStatus = 'current'");
                                                    if (mysqli_num_rows($checkQuarter2) > 0) { ?>
                                                        <button class="btn btn-primary m-2" name="disableQ2">2nd Quarter (CURRENT)</button>
                                                    <?php } else { ?>
                                                        <button type="submit" name="enableSecond" class="btn btn-secondary m-2">Enable 2nd Quarter</button>
                                                    <?php } ?>

                                                    <?php
                                                    $checkQuarter3 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 3 AND quarterStatus = 'current'");
                                                    if (mysqli_num_rows($checkQuarter3) > 0) { ?>
                                                        <button class="btn btn-primary m-2" name="disableQ3">3rd Quarter (CURRENT)</button>
                                                    <?php } else { ?>
                                                        <button type="submit" name="enableThird" class="btn btn-secondary m-2">Enable 3rd Quarter</button>
                                                    <?php } ?>

                                                    <?php
                                                    $checkQuarter4 = $mysqli->query("SELECT * FROM quartertable WHERE quarterTag = 4 AND quarterStatus = 'current'");
                                                    if (mysqli_num_rows($checkQuarter4) > 0) { ?>
                                                        <button class="btn btn-primary m-2" name="disableQ4">4th Quarter (CURRENT)</button>
                                                    <?php } else { ?>
                                                        <button type="submit" name="enableFourth" class="btn btn-secondary m-2">Enable 4th Quarter</button>
                                                    <?php } ?>
                                                </form>
                                            </div>
                                        </div>
                                        <div class=" row">
                                            <style>
                                                h3 {
                                                    font-family: "Lato", "san serif";
                                                }
                                            </style>
                                            <div class="col-sm-12 col-lg-6 grid-margin" style="padding-bottom:20px;">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <h3 style="font-size: 20px; padding-bottom: 20px; text-align:center;">Today's Average Attendance</h3>
                                                            <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                                            <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                                        </div>
                                                        <div class="row" style="margin: auto; padding-top:15px;">
                                                            <style>
                                                                table,
                                                                th,
                                                                td {
                                                                    border: 1px solid white;
                                                                    border-collapse: collapse;
                                                                    margin: auto;
                                                                }

                                                                th,
                                                                td {
                                                                    background-color: #f2f2f2;
                                                                    padding: 10px 10px 10px 10px;
                                                                    text-align: center;
                                                                }
                                                            </style>
                                                            <div class="col-6">
                                                                <table>

                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Kinder</td>
                                                                            <td><?php echo $KinderPresentNow['COUNT(studentrecord.SR_number)'] . " out of " . $AllKinder['COUNT(SR_number)'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Grade 1</td>
                                                                            <td><?php echo $Grade1PresentNow['COUNT(studentrecord.SR_number)'] . " out of " . $AllGrade1['COUNT(SR_number)'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Grade 2</td>
                                                                            <td><?php echo $Grade2PresentNow['COUNT(studentrecord.SR_number)'] . " out of " . $AllGrade2['COUNT(SR_number)'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Grade 3</td>
                                                                            <td><?php echo $Grade3PresentNow['COUNT(studentrecord.SR_number)'] . " out of " . $AllGrade3['COUNT(SR_number)'] ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="col-6">
                                                                <table>

                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Grade 4</td>
                                                                            <td><?php echo $Grade4PresentNow['COUNT(studentrecord.SR_number)'] . " out of " . $AllGrade4['COUNT(SR_number)'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Grade 5</td>
                                                                            <td><?php echo $Grade5PresentNow['COUNT(studentrecord.SR_number)'] . " out of " . $AllGrade5['COUNT(SR_number)'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Grade 6</td>
                                                                            <td><?php echo $Grade6PresentNow['COUNT(studentrecord.SR_number)'] . " out of " . $AllGrade6['COUNT(SR_number)'] ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 grid-margin">
                                                <div class="row">
                                                    <div class="col-sm-12 col-lg-4 grid-margin" style="padding-bottom:20px;">

                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <h3 style="font-size: 20px; padding-bottom: 20px; text-align:left;">Total No. of Students</h3>
                                                                    <div class="d-flex flex-shrink-0">
                                                                        <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628; padding-bottom:15px;">
                                                                            <?php
                                                                            $countNumofStudent = $mysqli->query("SELECT COUNT(*) FROM studentrecord");
                                                                            $numofStudent = $countNumofStudent->fetch_assoc();

                                                                            echo $numofStudent['COUNT(*)'];
                                                                            ?>
                                                                        </h1>
                                                                    </div>
                                                                    <div class="percentage">
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $numofStudent['COUNT(*)']; ?>; background-color:#c02628;" aria-valuenow="<?php echo $numofStudent['COUNT(*)']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12 col-lg-4 grid-margin" style="padding-bottom:20px;">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <h3 style="font-size: 20px; text-align:left;">Total No. of Faculty Teachers</h3>
                                                                    <div class="d-flex flex-shrink-0">
                                                                        <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628; padding-bottom:15px;">
                                                                            <?php
                                                                            $countNumofFaculty = $mysqli->query("SELECT COUNT(*) FROM faculty");
                                                                            $numofFaculty = $countNumofFaculty->fetch_assoc();

                                                                            echo $numofFaculty['COUNT(*)'];
                                                                            ?>
                                                                        </h1>
                                                                    </div>
                                                                    <div class="percentage">
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $numofFaculty['COUNT(*)'] ?>; background-color:#c02628;" aria-valuenow="<?php echo $numofFaculty['COUNT(*)'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-4 grid-margin" style="padding-bottom:20px;">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <h3 style="font-size: 20px; text-align:left;">Total No. of Students Added Today</h3>
                                                                    <div class="d-flex flex-shrink-0">
                                                                        <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628; padding-bottom:15px;">
                                                                            <?php
                                                                            $countNumofAddedStudent = $mysqli->query("SELECT COUNT(AD_action) FROM admin_logs WHERE AD_action = 'Added Student' AND logDate IN (SELECT CURDATE())");
                                                                            $AddedStudent = $countNumofAddedStudent->fetch_assoc();

                                                                            echo $AddedStudent['COUNT(AD_action)'];
                                                                            ?></h1>
                                                                    </div>
                                                                    <div class="percentage">
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $AddedStudent['COUNT(AD_action)']; ?>; background-color:#c02628;" aria-valuenow="<?php echo $AddedStudent['COUNT(AD_action)']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                                <div class="row">
                                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                                        <h4 class="card-title card-title-dash" style="margin-bottom:12px;">Activity History</h4>
                                                                    </div>
                                                                    <ul class="bullet-line-list">
                                                                        <?php
                                                                        $getLoggedData = $mysqli->query("SELECT * FROM admin_logs WHERE acadYear = '{$currentSchoolYear}' ORDER BY logDate LIMIT 5 ");
                                                                        if (mysqli_num_rows($getLoggedData) > 0) {
                                                                            while ($LoggedData = $getLoggedData->fetch_assoc()) { ?>
                                                                                <li>
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <div style="text-align: left;"><span class="text-light-green"><?php echo $LoggedData['AD_name'] ?></span><?php echo " - " . $LoggedData['AD_action'] ?></div>
                                                                                        <p><?php echo $LoggedData['logDate'] ?></p>
                                                                                    </div>
                                                                                </li>
                                                                            <?php } ?>

                                                                        <?php } else { ?>
                                                                            <li>
                                                                                <div class="d-flex justify-content-between">
                                                                                    <div style="text-align: center;"><span class="text-light-green"></span>No Data Available yet</div>
                                                                                </div>
                                                                            </li>
                                                                        <?php }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex flex-column">
                                                    <div class="row flex-grow">
                                                        <div class="col-sm-12 col-lg-8 grid-margin">
                                                            <div class="row">
                                                                <div class="col-lg-12 grid-margin stretch-card">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">Student List</h4>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>No.</th>
                                                                                            <th>Student Number</th>
                                                                                            <th>Student Name</th>
                                                                                            <th>Grade and Section</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        $rowCount = 1;
                                                                                        $studentPopulationData = $mysqli->query("SELECT * FROM studentrecord ORDER BY RAND() LIMIT 5");

                                                                                        if (mysqli_num_rows($studentPopulationData) > 0) {
                                                                                            while ($studentPopulation = $studentPopulationData->fetch_assoc()) { ?>
                                                                                                <tr>
                                                                                                    <td><?php echo $rowCount; ?></td>
                                                                                                    <td><?php echo $studentPopulation['SR_number']; ?></td>
                                                                                                    <td><?php echo $studentPopulation['SR_lname'] .  ", " . $studentPopulation['SR_fname'] . " " . substr($studentPopulation['SR_mname'], 0, 1) ?></td>
                                                                                                    <td><?php echo "Grade " . $studentPopulation['SR_grade'] . " - " . $studentPopulation['SR_section']; ?></td>
                                                                                                </tr>
                                                                                            <?php
                                                                                                $rowCount++;
                                                                                            }
                                                                                        } else { ?>
                                                                                            <tr>
                                                                                                <td colspan="4">No Data Avaiable</td>
                                                                                            </tr>
                                                                                        <?php }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <?php
                                                                            if (mysqli_num_rows($studentPopulationData) > 0) { ?>
                                                                                <div style="padding-top: 10px;">
                                                                                    <a href="../admin/student.php" class="fw-bold text-primary">View all students <i class="fa fa-arrow-right ms-2"></i></a>
                                                                                </div>
                                                                            <?php }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 grid-margin stretch-card">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">Faculty List</h4>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>No.</th>
                                                                                            <th>Faculty Number</th>
                                                                                            <th>Faculty Name</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        $rowCount = 1;
                                                                                        $facultyPopulationData = $mysqli->query("SELECT * FROM faculty ORDER BY RAND() LIMIT 5");

                                                                                        if (mysqli_num_rows($facultyPopulationData) > 0) {
                                                                                            while ($rowCount <= 5) {
                                                                                                $facultyPopulation = $facultyPopulationData->fetch_assoc(); ?>
                                                                                                <tr>
                                                                                                    <td><?php echo $rowCount; ?></td>
                                                                                                    <td><?php echo $facultyPopulation['F_number']; ?></td>
                                                                                                    <td><?php echo $facultyPopulation['F_lname'] .  ", " . $facultyPopulation['F_fname'] . " " . substr($facultyPopulation['F_mname'], 0, 1) ?></td>
                                                                                                </tr>
                                                                                            <?php
                                                                                                $rowCount++;
                                                                                            }
                                                                                        } else { ?>
                                                                                            <tr>
                                                                                                <td colspan="4">No Data Avaiable</td>
                                                                                            </tr>
                                                                                        <?php }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <?php
                                                                            if (mysqli_num_rows($facultyPopulationData) > 0) { ?>
                                                                                <div style="padding-top: 10px;">
                                                                                    <a href="../admin/faculty.php" class="fw-bold text-primary">View all faculty <i class="fa fa-arrow-right ms-2"></i></a>
                                                                                </div>
                                                                            <?php }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                                                        <h3 class="mb-0" style="text-align:left;">School Announcements</h3>
                                                                    </div>

                                                                    <?php
                                                                    $getAnnouncementData = $mysqli->query("SELECT * FROM announcement ORDER BY date");

                                                                    if (mysqli_num_rows($getAnnouncementData) > 0) {
                                                                        while ($announcement = $getAnnouncementData->fetch_assoc()) { ?>
                                                                            <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                                                                                <div class="blog-item bg-light rounded overflow-hidden">
                                                                                    <div class="p-4">
                                                                                        <div class="d-flex mb-3">
                                                                                            <small class="me-3"><i class="far fa-user text-primary me-2"></i><?php echo $announcement['author']; ?></small>
                                                                                            <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo $announcement['date']; ?></small>
                                                                                        </div>
                                                                                        <h4 class="mb-3" style="text-align: left;"><?php echo $announcement['header']; ?></h4>
                                                                                        <p class="text-truncate"><?php echo $announcement['msg']; ?></p>
                                                                                        <a class="text-uppercase" href="viewannouncement.php?postID=<?php echo $announcement['ANC_ID']; ?>">Read More <i class="bi bi-arrow-right"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                    } else { ?>
                                                                        <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                                                                            <div class="blog-item bg-light rounded overflow-hidden">
                                                                                <div class="p-4 text-center">
                                                                                    <h4 class="mb-3">NO ANNOUNCEMENT YET</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }
                                                                    ?>
                                                                    <section class="popular-courses-area courses-page">
                                                                        <div style="padding-top: 10px;">
                                                                            <a href="../admin/announcement.php" class="fw-bold text-primary">View all school announcements <i class="fa fa-arrow-right ms-2"></i></a>
                                                                        </div>
                                                                    </section>
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
</body>

<!-- Template Javascript -->
<script src="../assets/js/main.js"></script>

<script src="../assets/js/admin/vendor.bundle.base.js"></script>
<script src="../assets/js/admin/off-canvas.js"></script>
<script src="../assets/js/admin/progressbar.min.js"></script>
<script src="../assets/js/admin/Chart.min.js"></script>
<script>
    if ($("#doughnutChart").length) {
        var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
        var doughnutPieData = {
            datasets: [{
                data: arrayAttendance,
                backgroundColor: [
                    "#1F3BB3",
                    "#52CDFF",
                    "#81DADA",
                    "#F9F871",
                    "#008F7A",
                    "#845EC2",
                    "#C34A36"
                ],
                borderColor: [
                    "#1F3BB3",
                    "#52CDFF",
                    "#81DADA",
                    "#F9F871",
                    "#008F7A",
                    "#845EC2",
                    "#C34A36"
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'KINDER',
                'GR1',
                'GR2',
                'GR3',
                'GR4',
                'GR5',
                'GR6',
            ]
        };
        var doughnutPieOptions = {
            cutoutPercentage: 50,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
            maintainAspectRatio: true,
            showScale: true,
            legend: false,
            legendCallback: function(chart) {
                var text = [];
                text.push('<div class="chartjs-legend"><ul class="justify-content-center" style="margin-right: 0px">');
                for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                    text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">');
                    text.push('</span>');
                    if (chart.data.labels[i]) {
                        text.push(chart.data.labels[i]);
                    }
                    text.push('</li>');
                }
                text.push('</div></ul>');
                return text.join("");
            },

            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            tooltips: {
                callbacks: {
                    title: function(tooltipItem, data) {
                        return data['labels'][tooltipItem[0]['index']];
                    },
                    label: function(tooltipItem, data) {
                        return data['datasets'][0]['data'][tooltipItem['index']];
                    }
                },

                backgroundColor: '#fff',
                titleFontSize: 14,
                titleFontColor: '#0B0F32',
                bodyFontColor: '#737F8B',
                bodyFontSize: 11,
                displayColors: false
            }
        };
        var doughnutChart = new Chart(doughnutChartCanvas, {
            type: 'doughnut',
            data: doughnutPieData,
            options: doughnutPieOptions
        });
        document.getElementById('doughnut-chart-legend').innerHTML = doughnutChart.generateLegend();
    }
</script>

</html>